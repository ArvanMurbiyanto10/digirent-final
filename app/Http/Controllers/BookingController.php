public function store(Request $request): RedirectResponse
{
$validated = $request->validate([
'product_id' => 'required|exists:products,id',
'start_date' => 'required|date|after_or_equal:today',
'end_date' => 'required|date|after:start_date',
]);

/** @var \App\Models\Product $product */
$product = Product::findOrFail($validated['product_id']);

// ✅ PHPStan AMAN: start_date & end_date sudah string
$startDate = Carbon::parse($validated['start_date']);
$endDate = Carbon::parse($validated['end_date']);

$days = $startDate->diffInDays($endDate);
if ($days < 1) {
    $days=1;
    }

    $totalPrice=$days * (int) $product->price_per_day;

    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Midtrans config
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $orderId = 'RENT-' . time() . '-' . $user->id;

    $params = [
    'transaction_details' => [
    'order_id' => $orderId,
    'gross_amount' => $totalPrice,
    ],
    'customer_details' => [
    'first_name' => $user->name,
    'email' => $user->email,
    'phone' => $user->phone ?? '08123456789',
    ],
    'item_details' => [
    [
    'id' => $product->id,
    'price' => (int) $product->price_per_day,
    'quantity' => $days,
    'name' => substr($product->name ?? 'Produk', 0, 50),
    ]
    ]
    ];

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    Booking::create([
    'user_id' => $user->id,
    'product_id' => $product->id,
    'start_date' => $startDate,
    'end_date' => $endDate,
    'total_price' => $totalPrice,
    'status' => 'pending',
    'snap_token' => $snapToken,
    ]);

    return redirect()
    ->route('dashboard')
    ->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
    }