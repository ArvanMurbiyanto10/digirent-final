import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect'; // <-- 1. TAMBAHKAN INI

window.Alpine = Alpine;

Alpine.plugin(intersect); // <-- 2. TAMBAHKAN INI

Alpine.start();
