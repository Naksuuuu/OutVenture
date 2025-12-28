import './bootstrap';
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

window.Chart = Chart;

import L from './leaflet-config';
window.L = L;
