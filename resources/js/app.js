
import Alpine from 'alpinejs';

import intersect from '@alpinejs/intersect'
import collapse from '@alpinejs/collapse'

Alpine.plugin(intersect)
Alpine.plugin(collapse)

window.Alpine = Alpine;

Alpine.start();

import.meta.glob([
  '../images/**',
  '../fonts/**',
]);
