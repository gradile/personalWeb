<style type="text/css">
/* declare external fonts */
@font-face {
	font-family: Azbuka04;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Azbuka04.ttf');
}
@font-face {
	font-family: Cour;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/cour.ttf');
}
@font-face {
	font-family: DSNote;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/(DS)_Note.ttf');
}
@font-face {
	font-family: HebarU;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/HebarU.ttf');
}
@font-face {
	font-family: Montserrat-Regular;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Montserrat-Regular.otf');
}
@font-face {
	font-family: MTCORSVA;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/MTCORSVA.TTF');
}
@font-face {
	font-family: Nicoletta_script;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Nicoletta_script.ttf');
}
@font-face {
	font-family: Oswald-Regular;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Oswald-Regular.ttf');
}
@font-face {
	font-family: Regina Kursiv;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/ReginaKursiv.ttf');
}
@font-face {
	font-family: Raleway-Regular;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Raleway-Regular.ttf');
}
@font-face {
	font-family: Tex Gyre Adventor;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/texgyreadventor-regular.otf');
}
@font-face {
	font-family: Ubuntu-R;
	src: url('<?php echo $CONFIG["full_url"]; ?>fonts/Ubuntu-R.ttf');
}
/* div that wrap all the blog */
div.front_end_wrapper {
 	font-family:<?php echo $OptionsVis["gen_font_family"]; ?>;
 	font-size:<?php echo $OptionsVis["gen_font_size"]; ?> !important;
	margin:0 auto !important;
 	padding-top: <?php echo $OptionsVis["dist_from_top"]; ?> !important;
 	padding-bottom: <?php echo $OptionsVis["dist_from_bottom"]; ?> !important;
 	color:<?php echo $OptionsVis["gen_font_color"]; ?> !important;
 	text-align:<?php echo $OptionsVis["gen_text_align"]; ?>;
 	line-height:<?php echo $OptionsVis["gen_line_height"]; ?> !important;
	word-wrap:break-word !important;
 	<?php if(trim($OptionsVis["gen_width"])!='') { ?>  
	max-width: <?php echo trim($OptionsVis["gen_width"]); ?><?php echo $OptionsVis["gen_width_dim"]; ?> !important;
 	<?php
	}
	?>
}
.front_end_wrapper * {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
/* Extract from normalize.css by Nicolas Gallagher and Jonathan Neal git.io/normalize */

html {
	-ms-text-size-adjust:100%;
	-webkit-text-size-adjust:100%
}
body {
	margin:0
}
article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
	display:block
}
audio, canvas, video {
	display:inline-block;
	vertical-align:baseline
}
audio:not([controls]) {
	display:none;
	height:0
}
[hidden], template {
display:none
}
a {
	background-color:transparent
}
a:active, a:hover {
	outline:0
}
abbr[title] {
	border-bottom:1px dotted
}
dfn {
	font-style:italic
}
mark {
	background:#ff0;
	color:#000
}
small {
	font-size:80%
}
sub, sup {
	font-size:75%;
	line-height:0;
	position:relative;
	vertical-align:baseline
}
sup {
	top:-0.5em
}
sub {
	bottom:-0.25em
}
img {
	border:0
}
svg:not(:root) {
	overflow:hidden
}
figure {
	margin:1em 40px
}
hr {
	-moz-box-sizing:content-box;
	box-sizing:content-box
}
code, kbd, pre, samp {
	font-family:monospace, monospace;
	font-size:1em
}
button, input, select, textarea {
	font:inherit;
	margin:0
}
button {
	overflow:visible
}
button, select {
	text-transform:none
}
button, html input[type=button], input[type=reset], input[type=submit] {
	-webkit-appearance:button;
	cursor:pointer
}
button[disabled], html input[disabled] {
	cursor:default
}
 button::-moz-focus-inner, input::-moz-focus-inner {
	border:0;
	padding:0;
}
input[type=checkbox], input[type=radio] {
	padding:0;
}
input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button {
	height:auto;
}
input[type=search] {
	box-sizing:content-box;
	-webkit-appearance:textfield;
	-moz-box-sizing:content-box;
	-webkit-box-sizing:content-box
}
input[type=search]::-webkit-search-cancel-button, input[type=search]::-webkit-search-decoration {
-webkit-appearance:none
}
fieldset {
	border:1px solid #c0c0c0;
	margin:0 2px;
	padding:.35em .625em .75em
}
legend {
	border:0;
	padding:0
}
pre, textarea {
	overflow:auto
}
/* End extract from normalize.css */



/* w3 styles start */
.w3-serif {
	font-family:"Times New Roman", Times, serif
}
.w3-wide {
	letter-spacing:4px
}
.w3-table-all {
	border:1px solid #ccc
}
.w3-bordered tr, .w3-table-all tr {
	border-bottom:1px solid #ddd
}
.w3-striped tbody tr:nth-child(even) {
	background-color:#f1f1f1
}
.w3-table-all tr:nth-child(odd) {
	background-color:#fff
}
.w3-table-all tr:nth-child(even) {
	background-color:#f1f1f1
}
.w3-hoverable tbody tr:hover, .w3-ul.w3-hoverable li:hover {
	background-color:#ccc
}
.w3-centered tr th, .w3-centered tr td {
	text-align:center
}
.w3-table td, .w3-table th, .w3-table-all td, .w3-table-all th {
	padding:6px 8px;
	display:table-cell;
	text-align:left;
	vertical-align:top
}
.w3-table th:first-child, .w3-table td:first-child, .w3-table-all th:first-child, .w3-table-all td:first-child {
	padding-left:16px
}
.w3-btn, .w3-btn-block {
	border:none;
	display:inline-block;
	outline:0;
	padding:6px 16px;
	vertical-align:middle;
	overflow:hidden;
	text-decoration:none!important;
	color:#fff;
	background-color:#000;
	text-align:center;
	cursor:pointer;
	white-space:nowrap
}
.w3-disabled, .w3-btn:disabled, .w3-btn-floating:disabled, .w3-btn-floating-large:disabled {
	cursor:not-allowed;
	opacity:0.3
}
.w3-btn.w3-disabled *, .w3-btn-block.w3-disabled, .w3-btn-floating.w3-disabled *, .w3-btn:disabled *, .w3-btn-floating:disabled * {
	pointer-events:none
}
.w3-btn.w3-disabled:hover, .w3-btn-block.w3-disabled:hover, .w3-btn:disabled:hover, .w3-btn-floating.w3-disabled:hover, .w3-btn-floating:disabled:hover,  .w3-btn-floating-large.w3-disabled:hover, .w3-btn-floating-large:disabled:hover {
	box-shadow:none
}
.w3-btn:hover, .w3-btn-block:hover, .w3-btn-floating:hover, .w3-btn-floating-large:hover {
	box-shadow:0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19)
}
.w3-btn-block {
	width:100%
}
.w3-btn, .w3-btn-floating, .w3-btn-floating-large, .w3-closenav, .w3-opennav {
	-webkit-touch-callout:none;
	-webkit-user-select:none;
	-khtml-user-select:none;
	-moz-user-select:none;
	-ms-user-select:none;
	user-select:none
}
.w3-btn-floating, .w3-btn-floating-large {
	display:inline-block;
	text-align:center;
	color:#fff;
	background-color:#000;
	position:relative;
	overflow:hidden;
	z-index:1;
	padding:0;
	border-radius:50%;
	cursor:pointer;
	font-size:24px
}
.w3-btn-floating {
	width:40px;
	height:40px;
	line-height:40px
}
.w3-btn-floating-large {
	width:56px;
	height:56px;
	line-height:56px
}
.w3-btn-group .w3-btn {
	float:left
}
.w3-btn-bar .w3-btn {
	box-shadow:none;
	background-color:inherit;
	color:inherit;
	float:left
}
.w3-btn-bar .w3-btn:hover {
	background-color:#ccc
}
.w3-ripple {
	position:relative;
	overflow:hidden
}
.w3-ripple:after {
	content:"";
	background:#ccc;
	position:absolute;
	padding:300%;
	bottom:0;
	left:0;
	opacity:0;
	transition:0.8s
}
.w3-ripple:active:after {
	padding:0;
	opacity:1;
	transition:0s
}
.w3-badge, .w3-tag, .w3-sign {
	background-color:#000;
	color:#fff;
	display:inline-block;
	padding-left:8px;
	padding-right:8px;
	text-align:center
}
.w3-badge {
	border-radius:50%
}
ul.w3-ul {
	list-style-type:none;
	padding:0;
	margin:0
}
ul.w3-ul li {
	padding:6px 2px 6px 16px;
	border-bottom:1px solid #ddd
}
ul.w3-ul li:last-child {
	border-bottom:none
}
.w3-tooltip, .w3-display-container {
	position:relative
}
.w3-fluid {
	max-width:100%;
	height:auto
}
.w3-tooltip .w3-text {
	display:none
}
.w3-tooltip:hover .w3-text {
	display:inline-block
}
.w3-navbar {
	list-style-type:none;
	margin:0;
	padding:0;
	overflow:hidden
}
.w3-navbar li {
	float:left
}
.w3-navbar li a, .w3-navitem {
	display:block;
	padding:8px 16px
}
.w3-navbar li a:hover {
	color:#000;
	background-color:#ccc
}
.w3-navbar .w3-dropdown-hover, .w3-navbar .w3-dropdown-click {
	position:static
}
.w3-navbar .w3-dropdown-hover:hover, .w3-navbar .w3-dropdown-hover:first-child, .w3-navbar .w3-dropdown-click:hover {
	background-color:#ccc;
	color:#000
}
.w3-navbar a, .w3-topnav a, .w3-sidenav a, .w3-dropdown-content a, .w3-accordion-content a, .w3-dropnav a {
	text-decoration:none!important
}
.w3-navbar .w3-opennav.w3-right {
	float:right!important
}
.w3-topnav {
	padding:8px 8px
}
.w3-topnav a {
	padding:0 8px;
	border-bottom:3px solid transparent;
	-webkit-transition:border-bottom .3s;
	transition:border-bottom .3s
}
.w3-topnav a:hover {
	border-bottom:3px solid #fff
}
.w3-topnav .w3-dropdown-hover a {
	border-bottom:0
}
.w3-opennav, .w3-closenav {
	color:inherit
}
.w3-opennav:hover, .w3-closenav:hover {
	cursor:pointer;
	opacity:0.8
}
.w3-btn, .w3-btn-floating, .w3-dropnav a, .w3-btn-floating-large, .w3-btn-block, .w3-hover-shadow, .w3-hover-opacity,  .w3-navbar a, .w3-sidenav a, .w3-pagination li a, .w3-hoverable tbody tr, .w3-hoverable li, .w3-accordion-content a, .w3-dropdown-content a, .w3-dropdown-click:hover, .w3-dropdown-hover:hover, .w3-opennav, .w3-closenav, .w3-closebtn,  .w3-hover-amber, .w3-hover-aqua, .w3-hover-blue, .w3-hover-light-blue, .w3-hover-brown, .w3-hover-cyan, .w3-hover-blue-grey, .w3-hover-green, .w3-hover-light-green, .w3-hover-indigo, .w3-hover-khaki, .w3-hover-lime, .w3-hover-orange, .w3-hover-deep-orange, .w3-hover-pink,  .w3-hover-purple, .w3-hover-deep-purple, .w3-hover-red, .w3-hover-sand, .w3-hover-teal, .w3-hover-yellow, .w3-hover-white, .w3-hover-black, .w3-hover-grey, .w3-hover-light-grey, .w3-hover-dark-grey, .w3-hover-text-amber, .w3-hover-text-aqua, .w3-hover-text-blue, .w3-hover-text-light-blue,  .w3-hover-text-brown, .w3-hover-text-cyan, .w3-hover-text-blue-grey, .w3-hover-text-green, .w3-hover-text-light-green, .w3-hover-text-indigo, .w3-hover-text-khaki, .w3-hover-text-lime, .w3-hover-text-orange, .w3-hover-text-deep-orange, .w3-hover-text-pink, .w3-hover-text-purple,  .w3-hover-text-deep-purple, .w3-hover-text-red, .w3-hover-text-sand, .w3-hover-text-teal, .w3-hover-text-yellow, .w3-hover-text-white, .w3-hover-text-black, .w3-hover-text-grey, .w3-hover-text-light-grey, .w3-hover-text-dark-grey {
	-webkit-transition:background-color .3s, color .15s, box-shadow .3s, opacity 0.3s;
	transition:background-color .3s, color .15s, box-shadow .3s, opacity 0.3s
}
.w3-sidenav {
	height:100%;
	width:200px;
	background-color:#fff;
	position:fixed!important;
	z-index:1;
	overflow:auto
}
.w3-sidenav a {
	padding:4px 2px 4px 16px
}
.w3-sidenav a:hover {
	background-color:#ccc
}
.w3-sidenav a, .w3-dropnav a {
	display:block
}
.w3-sidenav .w3-dropdown-hover:hover, .w3-sidenav .w3-dropdown-hover:first-child, .w3-sidenav .w3-dropdown-click:hover, .w3-dropnav a:hover {
	background-color:#ccc;
	color:#000
}
.w3-sidenav .w3-dropdown-hover, .w3-sidenav .w3-dropdown-click {
	width:100%
}
.w3-sidenav .w3-dropdown-hover .w3-dropdown-content, .w3-sidenav .w3-dropdown-click .w3-dropdown-content {
	min-width:100%
}
/*.w3-main,#main{transition:margin-left .4s}*/

.w3-modal {
	z-index:3;
	display:none;
	padding-top:100px;
	position:fixed;
	left:0;
	top:0;
	width:100%;
	height:100%;
	overflow:auto;
	background-color:rgb(0,0,0);
	background-color:rgba(0,0,0,0.4)
}
.w3-modal-content {
	margin:auto;
	background-color:#fff;
	position:relative;
	padding:0;
	outline:0;
	width:600px
}
.w3-closebtn {
	text-decoration:none;
	float:right;
	font-size:24px;
	font-weight:bold;
	color:inherit
}
.w3-closebtn:hover, .w3-closebtn:focus {
	color:#000;
	text-decoration:none;
	cursor:pointer
}
.w3-pagination {
	display:inline-block;
	padding:0;
	margin:0
}
.w3-pagination li {
	display:inline
}
.w3-pagination li a {
	text-decoration:none;
	color:#000;
	float:left;
	padding:8px 16px
}
.w3-pagination li a:hover {
	background-color:#ccc
}
.w3-input-group, .w3-group {
	margin-top:24px;
	margin-bottom:24px
}
.w3-input {
	padding:8px;
	display:block;
	border:none;
	border-bottom:1px solid #808080;
	width:100%
}
.w3-label {
	color:#009688
}
.w3-input:not(:valid)~.w3-validate {
color:#f44336
}
.w3-select {
	padding:9px 0;
	width:100%;
	color:#000;
	border:1px solid transparent;
	border-bottom:1px solid #009688
}
.w3-select select:focus {
	color:#000;
	border:1px solid #009688
}
.w3-select option[disabled] {
	color:#009688
}
.w3-dropdown-click, .w3-dropdown-hover {
	position:relative;
	display:inline-block;
	cursor:pointer
}
.w3-dropdown-hover:hover .w3-dropdown-content {
	display:block;
	z-index:1
}
.w3-dropdown-content {
	cursor:auto;
	color:#000;
	background-color:#fff;
	display:none;
	position:absolute;
	min-width:160px;
	margin:0;
	padding:0
}
.w3-dropdown-content a {
	padding:6px 16px;
	display:block
}
.w3-dropdown-content a:hover {
	background-color:#ccc
}
.w3-accordion {
	width:100%;
	cursor:pointer
}
.w3-accordion-content {
	cursor:auto;
	display:none;
	position:relative;
	width:100%;
	margin:0;
	padding:0
}
.w3-accordion-content a {
	padding:6px 16px;
	display:block
}
.w3-accordion-content a:hover {
	background-color:#ccc
}
.w3-progress-container {
	width:100%;
	height:1.5em;
	position:relative;
	background-color:#f1f1f1
}
.w3-progressbar {
	background-color:#757575;
	height:100%;
	position:absolute;
	line-height:inherit
}
input[type=checkbox].w3-check, input[type=radio].w3-radio {
	width:24px;
	height:24px;
	position:relative;
	top:6px
}
input[type=checkbox].w3-check:checked+.w3-validate, input[type=radio].w3-radio:checked+.w3-validate {
	color:#009688
}
input[type=checkbox].w3-check:disabled+.w3-validate, input[type=radio].w3-radio:disabled+.w3-validate {
	color:#aaa
}
.w3-responsive {
	overflow-x:auto
}
.w3-container:after, .w3-panel:after, .w3-row:after, .w3-row-padding:after, .w3-topnav:after, .w3-clear:after, .w3-btn-group:before, .w3-btn-group:after, .w3-btn-bar:before, .w3-btn-bar:after {
	content:"";
	display:table;
	clear:both
}
.w3-col, .w3-half, .w3-third, .w3-twothird, .w3-threequarter, .w3-quarter {
	float:left;
	width:100%
}
.w3-col.s1 {
	width:8.33333%
}
.w3-col.s2 {
	width:16.66666%
}
.w3-col.s3 {
	width:24.99999%
}
.w3-col.s4 {
	width:33.33333%
}
.w3-col.s5 {
	width:41.66666%
}
.w3-col.s6 {
	width:49.99999%
}
.w3-col.s7 {
	width:58.33333%
}
.w3-col.s8 {
	width:66.66666%
}
.w3-col.s9 {
	width:74.99999%
}
.w3-col.s10 {
	width:83.33333%
}
.w3-col.s11 {
	width:91.66666%
}
.w3-col.s12, .w3-half, .w3-third, .w3-twothird, .w3-threequarter, .w3-quarter {
	width:99.99999%
}
@media only screen and (min-width:601px) {
	.w3-col.m1 {
		width:8.33333%
	}
	.w3-col.m2 {
		width:16.66666%
	}
	.w3-col.m3, .w3-quarter {
		width:24.99999%
	}
	.w3-col.m4, .w3-third {
		width:33.33333%
	}
	.w3-col.m5 {
		width:41.66666%
	}
	.w3-col.m6, .w3-half {
		width:49.99999%
	}
	.w3-col.m7 {
		width:58.33333%
	}
	.w3-col.m8, .w3-twothird {
		width:66.66666%
	}
	.w3-col.m9, .w3-threequarter {
		width:74.99999%
	}
	.w3-col.m10 {
		width:83.33333%
	}
	.w3-col.m11 {
		width:91.66666%
	}
	.w3-col.m12 {
		width:99.99999%
	}
}
@media only screen and (min-width:993px) {
	.w3-col.l1 {
		width:8.33333%
	}
	.w3-col.l2 {
		width:16.66666%
	}
	.w3-col.l3, .w3-quarter {
		width:24.99999%
	}
	.w3-col.l4, .w3-third {
		width:33.33333%
	}
	.w3-col.l5 {
		width:41.66666%
	}
	.w3-col.l6, .w3-half {
		width:49.99999%
	}
	.w3-col.l7 {
		width:58.33333%
	}
	.w3-col.l8, .w3-twothird {
		width:66.66666%
	}
	.w3-col.l9, .w3-threequarter {
		width:74.99999%
	}
	.w3-col.l10 {
		width:83.33333%
	}
	.w3-col.l11 {
		width:91.66666%
	}
	.w3-col.l12 {
		width:99.99999%
	}
}
/*.w3-content{max-width:980px;margin:auto}*/
.w3-rest {
	overflow:hidden
}
.w3-hide {
	display:none!important
}
.w3-show-block, .w3-show {
	display:block!important
}
.w3-show-inline-block {
	display:inline-block!important
}
@media (max-width:600px) {
	.w3-modal-content {
		margin:0 10px;
		width:auto!important
	}
	.w3-modal {
		padding-top:30px
	}
}
@media (max-width:768px) {
	.w3-modal-content {
		width:500px
	}
	.w3-modal {
		padding-top:50px
	}
}
@media (min-width:993px) {
	.w3-modal-content {
		width:900px
	}
}
@media screen and (max-width:600px) {
	.w3-topnav a {
		display:block
	}
	.w3-navbar li:not(.w3-opennav) {
		float:none;
		width:100%!important
	}
	.w3-navbar li.w3-right {
		float:none!important
	}
}
@media screen and (max-width:600px) {
	.w3-topnav .w3-dropdown-hover .w3-dropdown-content, .w3-navbar .w3-dropdown-click .w3-dropdown-content, .w3-navbar .w3-dropdown-hover .w3-dropdown-content {
		position:relative
	}
}
@media screen and (max-width:600px) {
	.w3-topnav, .w3-navbar {
		text-align:center
	}
}
@media (max-width:600px) {
	.w3-hide-small {
		display:none!important
	}
}
@media (max-width:992px) and (min-width:601px) {
	.w3-hide-medium {
		display:none!important
	}
}
@media (min-width:993px) {
	.w3-hide-large {
		display:none!important
	}
}
@media screen and (min-width:993px) {
	.w3-sidenav.w3-collapse {
		display:block!important
	}
}
.w3-top, .w3-bottom {
	position:fixed;
	width:100%;
	z-index:1
}
.w3-top {
	top:0
}
.w3-bottom {
	bottom:0
}
.w3-overlay {
	position:fixed;
	display:none;
	width:100%;
	height:100%;
	top:0;
	left:0;
	right:0;
	bottom:0;
	background-color:rgba(0,0,0,0.5);
	z-index:2
}
.w3-left {
	float:left!important
}
.w3-right {
	float:right!important
}
.w3-tiny {
	font-size:10px!important
}
.w3-small {
	font-size:12px!important
}
.w3-medium {
	font-size:15px!important
}
.w3-large {
	font-size:18px!important
}
.w3-xlarge {
	font-size:24px!important
}
.w3-xxlarge {
	font-size:36px!important
}
.w3-xxxlarge {
	font-size:48px!important
}
.w3-jumbo {
	font-size:64px!important
}
.w3-vertical {
	word-break:break-all;
	line-height:1;
	text-align:center;
	width:0.6em
}
.w3-left-align {
	text-align:left!important
}
.w3-right-align {
	text-align:right!important
}
.w3-justify {
	text-align:justify!important
}
.w3-center {
	text-align:center!important
}
.w3-display-topleft {
	position:absolute;
	left:0;
	top:0
}
.w3-display-topright {
	position:absolute;
	right:0;
	top:0
}
.w3-display-bottomleft {
	position:absolute;
	left:0;
	bottom:0
}
.w3-display-bottomright {
	position:absolute;
	right:0;
	bottom:0
}
.w3-display-middle {
	position:absolute;
	top:50%;
	left:50%;
	transform:translate(-50%, -50%);
	-ms-transform:translate(-50%, -50%)
}
.w3-display-topmiddle {
	position:absolute;
	left:0;
	top:0;
	width:100%;
	text-align:center
}
.w3-display-bottommiddle {
	position:absolute;
	left:0;
	bottom:0;
	width:100%;
	text-align:center
}
.w3-circle {
	border-radius:50%!important
}
.w3-round-small {
	border-radius:2px!important
}
.w3-round, .w3-round-medium {
	border-radius:4px!important
}
.w3-round-large {
	border-radius:8px!important
}
.w3-round-xlarge {
	border-radius:16px!important
}
.w3-round-xxlarge {
	border-radius:32px!important
}
.w3-round-jumbo {
	border-radius:64px!important
}
.w3-border-0 {
	border:0!important
}
.w3-border {
	border:1px solid #ccc!important
}
.w3-border-top {
	border-top:1px solid #ccc!important
}
.w3-border-bottom {
	border-bottom:1px solid #ccc!important
}
.w3-border-left {
	border-left:1px solid #ccc!important
}
.w3-border-right {
	border-right:1px solid #ccc!important
}
.w3-margin {
	margin:16px!important
}
.w3-margin-0 {
	margin:0!important
}
.w3-margin-top {
	margin-top:16px!important
}
.w3-margin-bottom {
	margin-bottom:16px!important
}
.w3-margin-left {
	margin-left:16px!important
}
.w3-margin-right {
	margin-right:16px!important
}
.w3-section {
	margin-top:16px!important;
	margin-bottom:16px!important
}
.w3-padding-tiny {
	padding:2px 4px!important
}
.w3-padding-small {
	padding:4px 8px!important
}
.w3-padding-medium, .w3-padding, .w3-form {
	padding:8px 16px!important
}
.w3-padding-large {
	padding:12px 24px!important
}
.w3-padding-xlarge {
	padding:16px 32px!important
}
.w3-padding-xxlarge {
	padding:24px 48px!important
}
.w3-padding-jumbo {
	padding:32px 64px!important
}
.w3-padding-4 {
	padding-top:4px!important;
	padding-bottom:4px!important
}
.w3-padding-8 {
	padding-top:8px!important;
	padding-bottom:8px!important
}
.w3-padding-12 {
	padding-top:12px!important;
	padding-bottom:12px!important
}
.w3-padding-16 {
	padding-top:16px!important;
	padding-bottom:16px!important
}
.w3-padding-24 {
	padding-top:24px!important;
	padding-bottom:24px!important
}
.w3-padding-32 {
	padding-top:32px!important;
	padding-bottom:32px!important
}
.w3-padding-48 {
	padding-top:48px!important;
	padding-bottom:48px!important
}
.w3-padding-64 {
	padding-top:64px!important;
	padding-bottom:64px!important
}
.w3-padding-128 {
	padding-top:128px!important;
	padding-bottom:128px!important
}
.w3-padding-0 {
	padding:0!important
}
.w3-padding-top {
	padding-top:8px!important
}
.w3-padding-bottom {
	padding-bottom:8px!important
}
.w3-padding-left {
	padding-left:16px!important
}
.w3-padding-right {
	padding-right:16px!important
}
.w3-topbar {
	border-top:6px solid #ccc!important
}
.w3-leftbar {
	border-left:6px solid #ccc!important
}
.w3-rightbar {
	border-right:6px solid #ccc!important
}
.w3-row-padding, .w3-row-padding>.w3-half, .w3-row-padding>.w3-third, .w3-row-padding>.w3-twothird, .w3-row-padding>.w3-threequarter, .w3-row-padding>.w3-quarter, .w3-row-padding>.w3-col {
	padding:0 8px
}
.w3-spin {
	animation:w3-spin 2s infinite linear;
	-webkit-animation:w3-spin 2s infinite linear
}
@-webkit-keyframes w3-spin {
	0% {
		-webkit-transform:rotate(0deg);
		transform:rotate(0deg);
	}
	100% {
		-webkit-transform:rotate(359deg);
		transform:rotate(359deg);
	}
}
@keyframes w3-spin {
	0% {
		-webkit-transform:rotate(0deg);
		transform:rotate(0deg);
	}
	100% {
		-webkit-transform:rotate(359deg);
		transform:rotate(359deg);
	}
}
.w3-container {
	padding:0.01em 14px
}
.w3-panel {
	padding:0.01em 16px;
	margin-top:16px!important;
	margin-bottom:16px!important
}
.w3-example {
	background-color:#f1f1f1;
	padding:0.01em 16px
}
.w3-code, .w3-codespan {
	font-family:Consolas, "courier new";
	font-size:16px
}
.w3-code {
	line-height:1.4;
	width:auto;
	background-color:#fff;
	padding:8px 12px;
	border-left:4px solid #009688;
	word-wrap:break-word
}
.w3-codespan {
	color:crimson;
	background-color:#f1f1f1;
	padding-left:4px;
	padding-right:4px;
	font-size:110%
}
.w3-example, .w3-code, .w3-reference {
	margin:20px 0
}
.w3-card {
	border:1px solid #ccc
}
.w3-card-2, .w3-example {
	box-shadow:0 2px 4px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12)!important
}
.w3-card-4, .w3-hover-shadow:hover {
	box-shadow:0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19)!important
}
.w3-card-8 {
	box-shadow:0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19)!important
}
.w3-card-12 {
	box-shadow:0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19)!important
}
.w3-card-16 {
	box-shadow:0 16px 24px 0 rgba(0,0,0,0.22), 0 25px 55px 0 rgba(0,0,0,0.21)!important
}
.w3-card-24 {
	box-shadow:0 24px 24px 0 rgba(0,0,0,0.2), 0 40px 77px 0 rgba(0,0,0,0.22)!important
}
.w3-animate-fading {
	-webkit-animation:fading 10s infinite;
	animation:fading 10s infinite
}
@-webkit-keyframes fading {
	0% {
		opacity:0;
	}
	50% {
		opacity:1;
	}
	100% {
		opacity:0;
	}
}
@keyframes fading {
	0% {
		opacity:0;
	}
	50% {
		opacity:1;
	}
	100% {
		opacity:0;
	}
}
.w3-animate-opacity {
	-webkit-animation:opac 1.5s;
	animation:opac 1.5s
}
@-webkit-keyframes opac {
	from {
		opacity:0;
	}
	to {
		opacity:1;
	}
}
@keyframes opac {
	from {
		opacity:0;
	}
	to {
		opacity:1;
	}
}
.w3-animate-top {
	position:relative;
	-webkit-animation:animatetop 0.4s;
	animation:animatetop 0.4s
}
@-webkit-keyframes animatetop {
	from {
		top:-300px;
		opacity:0;
	}
	to {
		top:0;
		opacity:1;
	}
}
@keyframes animatetop {
	from {
		top:-300px;
		opacity:0;
	}
	to {
		top:0;
		opacity:1;
	}
}
.w3-animate-left {
	position:relative;
	-webkit-animation:animateleft 0.4s;
	animation:animateleft 0.4s
}
 @-webkit-keyframes animateleft {
	from {
		left:-300px;
		opacity:0;
	}
	to {
		left:0;
		opacity:1;
	}
}
 @keyframes animateleft {
	from {
		left:-300px;
		opacity:0;
	}
	to {
		left:0;
		opacity:1;
	}
}
.w3-animate-right {
	position:relative;
	-webkit-animation:animateright 0.4s;
	animation:animateright 0.4s
}
 @-webkit-keyframes animateright {
	from {
		right:-300px;
		opacity:0;
	}
	to {
		right:0;
		opacity:1;
	}
}
 @keyframes animateright {
	from {
		right:-300px;
		opacity:0;
	}
	to {
		right:0;
		opacity:1;
	}
}
.w3-animate-bottom {
	position:relative;
	-webkit-animation:animatebottom 0.4s;
	animation:animatebottom 0.4s
}
 @-webkit-keyframes animatebottom {
	from {
		bottom:-300px;
		opacity:0;
	}
	to {
		bottom:0px;
		opacity:1;
	}
}
 @keyframes animatebottom {
	from {
		bottom:-300px;
		opacity:0;
	}
	to {
		bottom:0;
		opacity:1;
	}
}
.w3-animate-zoom {
	-webkit-animation:animatezoom 0.6s;
	animation:animatezoom 0.6s
}
 @-webkit-keyframes animatezoom {
	from {
		-webkit-transform:scale(0)
	}
	to {
		-webkit-transform:scale(1)
	}
}
@keyframes animatezoom {
	from {
		transform:scale(0);
	}
	to {
		transform:scale(1);
	}
}
.w3-animate-input {
	-webkit-transition:width 0.4s ease-in-out;
	transition:width 0.4s ease-in-out
}
.w3-animate-input:focus {
	width:100%!important
}
.w3-opacity, .w3-hover-opacity:hover {
	opacity:0.60;
	filter:alpha(opacity=60)
}
.w3-text-shadow {
	text-shadow:1px 1px 0 #444
}
.w3-text-shadow-white {
	text-shadow:1px 1px 0 #ddd
}
.w3-transparent {
	background-color:transparent!important
}
.w3-hover-none:hover {
	box-shadow:none!important;
	background-color:transparent!important
}
/* Start of colors */

.w3-amber, .w3-hover-amber:hover {
	color:#000!important;
	background-color:#ffc107!important
}
.w3-aqua, .w3-hover-aqua:hover {
	color:#000!important;
	background-color:#00ffff!important
}
.w3-blue, .w3-hover-blue:hover {
	color:#fff!important;
	background-color:#2196F3!important
}
.w3-light-blue, .w3-hover-light-blue:hover {
	color:#000!important;
	background-color:#87CEEB!important
}
.w3-brown, .w3-hover-brown:hover {
	color:#fff!important;
	background-color:#795548!important
}
.w3-cyan, .w3-hover-cyan:hover {
	color:#000!important;
	background-color:#00bcd4!important
}
.w3-blue-grey, .w3-hover-blue-grey:hover {
	color:#fff!important;
	background-color:#607d8b!important
}
.w3-green, .w3-hover-green:hover {
	color:#fff!important;
	background-color:#4CAF50!important
}
.w3-light-green, .w3-hover-light-green:hover {
	color:#000!important;
	background-color:#8bc34a!important
}
.w3-indigo, .w3-hover-indigo:hover {
	color:#fff!important;
	background-color:#3f51b5!important
}
.w3-khaki, .w3-hover-khaki:hover {
	color:#000!important;
	background-color:#f0e68c!important
}
.w3-lime, .w3-hover-lime:hover {
	color:#000!important;
	background-color:#cddc39!important
}
.w3-orange, .w3-hover-orange:hover {
	color:#000!important;
	background-color:#ff9800!important
}
.w3-deep-orange, .w3-hover-deep-orange:hover {
	color:#fff!important;
	background-color:#ff5722!important
}
.w3-pink, .w3-hover-pink:hover {
	color:#fff!important;
	background-color:#e91e63!important
}
.w3-purple, .w3-hover-purple:hover {
	color:#fff!important;
	background-color:#9c27b0!important
}
.w3-deep-purple, .w3-hover-deep-purple:hover {
	color:#fff!important;
	background-color:#673ab7!important
}
.w3-red, .w3-hover-red:hover {
	color:#fff!important;
	background-color:#f44336!important
}
.w3-sand, .w3-hover-sand:hover {
	color:#000!important;
	background-color:#fdf5e6!important
}
.w3-teal, .w3-hover-teal:hover {
	color:#fff!important;
	background-color:#009688!important
}
.w3-yellow, .w3-hover-yellow:hover {
	color:#000!important;
	background-color:#ffeb3b!important
}
.w3-white, .w3-hover-white:hover {
	color:#000!important;
	background-color:#fff!important
}
.w3-black, .w3-hover-black:hover {
	color:#fff!important;
	background-color:#000!important
}
.w3-grey, .w3-hover-grey:hover {
	color:#000!important;
	background-color:#9e9e9e!important
}
.w3-light-grey, .w3-hover-light-grey:hover {
	color:#000!important;
	background-color:#f1f1f1!important
}
.w3-dark-grey, .w3-hover-dark-grey:hover {
	color:#fff!important;
	background-color:#616161!important
}
.w3-pale-red, .w3-hover-pale-red:hover {
	color:#000!important;
	background-color:#ffdddd!important
}
.w3-pale-green, .w3-hover-pale-green:hover {
	color:#000!important;
	background-color:#ddffdd!important
}
.w3-pale-yellow, .w3-hover-pale-yellow:hover {
	color:#000!important;
	background-color:#ffffcc!important
}
.w3-pale-blue, .w3-hover-pale-blue:hover {
	color:#000!important;
	background-color:#ddffff!important
}
.w3-text-amber, .w3-hover-text-amber:hover {
	color:#ffc107!important
}
.w3-text-aqua, .w3-hover-text-aqua:hover {
	color:#00ffff!important
}
.w3-text-blue, .w3-hover-text-blue:hover {
	color:#2196F3!important
}
.w3-text-light-blue, .w3-hover-text-light-blue:hover {
	color:#87CEEB!important
}
.w3-text-brown, .w3-hover-text-brown:hover {
	color:#795548!important
}
.w3-text-cyan, .w3-hover-text-cyan:hover {
	color:#00bcd4!important
}
.w3-text-blue-grey, .w3-hover-text-blue-grey:hover {
	color:#607d8b!important
}
.w3-text-green, .w3-hover-text-green:hover {
	color:#4CAF50!important
}
.w3-text-light-green, .w3-hover-text-light-green:hover {
	color:#8bc34a!important
}
.w3-text-indigo, .w3-hover-text-indigo:hover {
	color:#3f51b5!important
}
.w3-text-khaki, .w3-hover-text-khaki:hover {
	color:#b4aa50!important
}
.w3-text-lime, .w3-hover-text-lime:hover {
	color:#cddc39!important
}
.w3-text-orange, .w3-hover-text-orange:hover {
	color:#ff9800!important
}
.w3-text-deep-orange, .w3-hover-text-deep-orange:hover {
	color:#ff5722!important
}
.w3-text-pink, .w3-hover-text-pink:hover {
	color:#e91e63!important
}
.w3-text-purple, .w3-hover-text-purple:hover {
	color:#9c27b0!important
}
.w3-text-deep-purple, .w3-hover-text-deep-purple:hover {
	color:#673ab7!important
}
.w3-text-red, .w3-hover-text-red:hover {
	color:#f44336!important
}
.w3-text-sand, .w3-hover-text-sand:hover {
	color:#fdf5e6!important
}
.w3-text-teal, .w3-hover-text-teal:hover {
	color:#009688!important
}
.w3-text-yellow, .w3-hover-text-yellow:hover {
	color:#d2be0e!important
}
.w3-text-white, .w3-hover-text-white:hover {
	color:#fff!important
}
.w3-text-black, .w3-hover-text-black:hover {
	color:#000!important
}
.w3-text-grey, .w3-hover-text-grey:hover {
	color:#757575!important
}
.w3-text-light-grey, .w3-hover-text-light-grey:hover {
	color:#f1f1f1!important
}
.w3-text-dark-grey, .w3-hover-text-dark-grey:hover {
	color:#3a3a3a!important
}
.w3-border-amber, .w3-hover-border-amber:hover {
	border-color:#ffc107!important
}
.w3-border-aqua, .w3-hover-border-aqua:hover {
	border-color:#00ffff!important
}
.w3-border-blue, .w3-hover-border-blue:hover {
	border-color:#2196F3!important
}
.w3-border-light-blue, .w3-hover-border-light-blue:hover {
	border-color:#87CEEB!important
}
.w3-border-brown, .w3-hover-border-brown:hover {
	border-color:#795548!important
}
.w3-border-cyan, .w3-hover-border-cyan:hover {
	border-color:#00bcd4!important
}
.w3-border-blue-grey, .w3-hover-blue-grey:hover {
	border-color:#607d8b!important
}
.w3-border-green, .w3-hover-border-green:hover {
	border-color:#4CAF50!important
}
.w3-border-light-green, .w3-hover-border-light-green:hover {
	border-color:#8bc34a!important
}
.w3-border-indigo, .w3-hover-border-indigo:hover {
	border-color:#3f51b5!important
}
.w3-border-khaki, .w3-hover-border-khaki:hover {
	border-color:#f0e68c!important
}
.w3-border-lime, .w3-hover-border-lime:hover {
	border-color:#cddc39!important
}
.w3-border-orange, .w3-hover-border-orange:hover {
	border-color:#ff9800!important
}
.w3-border-deep-orange, .w3-hover-border-deep-orange:hover {
	border-color:#ff5722!important
}
.w3-border-pink, .w3-hover-border-pink:hover {
	border-color:#e91e63!important
}
.w3-border-purple, .w3-hover-border-purple:hover {
	border-color:#9c27b0!important
}
.w3-border-deep-purple, .w3-hover-border-deep-purple:hover {
	border-color:#673ab7!important
}
.w3-border-red, .w3-hover-border-red:hover {
	border-color:#f44336!important
}
.w3-border-sand, .w3-hover-border-sand:hover {
	border-color:#fdf5e6!important
}
.w3-border-teal, .w3-hover-border-teal:hover {
	border-color:#009688!important
}
.w3-border-yellow, .w3-hover-border-yellow:hover {
	border-color:#ffeb3b!important
}
.w3-border-white, .w3-hover-border-white:hover {
	border-color:#fff!important
}
.w3-border-black, .w3-hover-border-black:hover {
	border-color:#000!important
}
.w3-border-grey, .w3-hover-border-grey:hover {
	border-color:#9e9e9e!important
}
.w3-border-light-grey, .w3-hover-border-light-grey:hover {
	border-color:#f1f1f1!important
}
.w3-border-dark-grey, .w3-hover-border-dark-grey:hover {
	border-color:#616161!important
}
.w3-border-pale-red, .w3-hover-border-pale-red:hover {
	border-color:#ffe7e7!important
}
.w3-border-pale-green, .w3-hover-border-pale-green:hover {
	border-color:#e7ffe7!important
}
.w3-border-pale-yellow, .w3-hover-border-pale-yellow:hover {
	border-color:#ffffcc!important
}
.w3-border-pale-blue, .w3-hover-border-pale-blue:hover {
	border-color:#e7ffff!important
}
/* clear float div recurring */

div.clearboth {
	clear:both !important;
	height:0 !important;
	line-height:0 !important;
	font-size:0 !important;
	padding:0 !important;
	margin:0 !important;
}
div.clearclean {
	clear:both !important;
}
.padd-l-r-0 {
	padding-left: 0px;
	padding-right: 0px;
}
.dbl-third-padd-float {
	float:left;
 	width: <?php if(trim($OptionsVis["thumb_per_line"])!="") { echo $OptionsVis["thumb_per_line"]; } else { echo "33.33"; } ?>%;
	padding: 1.5%;
}
@media only screen and (max-width:600px) {
	.dbl-third-padd-float {
		float:left;
		width: 100%;
		padding: 1.5%;
	}
}
/* search form style */

div.search_form_wrap {
	float:right;
}
div.search_form {
	text-align: right !important;
	width: 100%;/* border: solid 1px #6600FF; */	

}
div.search_form form {
	margin:0 !important;
	padding:0 !important;
}
@media only screen and (max-width:600px) {
	div.search_form_wrap {
		padding-bottom: 18px !important;
	}
}
/* search input text field start */

.inputsearch[type=text] {
 	<?php if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') { ?>  width: 100%;
 	max-width: 280px;
 	border-bottom: 1px solid <?php echo $OptionsVis["sear_bor_color"]; ?> !important;
 	padding-bottom: 5px !important;
 	<?php
	} else { ?>  
	width: 0px;
 	<?php } ?>  
	box-sizing: border-box;
 	border: 0;
 	font-size: <?php echo $OptionsVis["sb_font_size"]; ?> !important;
 	background-color: white;
 	background-image: url('<?php echo $CONFIG["full_url"]; ?>images/searchicon.png');
 	background-size: 18px 18px;
 	background-position: right 10px center;
 	background-repeat: no-repeat;
 	padding: 6px 36px 6px 6px;
 	color: <?php echo $OptionsVis["sear_color"]; ?> !important;
}
.inputsearch[type=text]:focus {
	width: 100%;
	max-width: 280px;
 border-bottom: 1px solid <?php echo $OptionsVis["sear_bor_color"];
?>;
	padding-bottom: 5px;
	background-size: 21px 21px;
}
@media screen and (max-width: 600px) {
	div.search_form_wrap {
		float: none;
		/* padding-top: <?php echo $OptionsVis["dist_search_title"];?> !important; */
		clear: both;
	}
	.inputsearch[type=text] {
 	<?php if(isset($_REQUEST["search"]) and $_REQUEST["search"]!='') { ?>  width: 100%;
 	max-width: 100%;
 	<?php } else { ?>  
	width: 0px;
 	<?php } ?>
	}
	.inputsearch[type=text]:focus {
		width: 100%;
		max-width: 100%;
	}
}
/* search input text field end */



.cat_menu {
 	color: <?php if(trim($OptionsVis["cat_menu_color"])!="") { echo $OptionsVis["cat_menu_color"]; } else { echo "inherit"; } ?>;
 	background-color: <?php if(trim($OptionsVis["cat_menu_bgr"])!="") { echo $OptionsVis["cat_menu_bgr"]; } else { echo "inherit"; } ?>;
 	font-family: <?php echo $OptionsVis["cat_menu_family"]; ?>;
 	font-size: <?php echo $OptionsVis["cat_menu_size"]; ?>;
 	font-weight: <?php echo $OptionsVis["cat_menu_weight"]; ?>;
}
.cat_menu_sel {
 	color: <?php if(trim($OptionsVis["cat_menu_color_sel"])!="") { echo $OptionsVis["cat_menu_color_sel"]." !important;"; } else { echo "inherit"; } ?>;
 	background-color: <?php if(trim($OptionsVis["cat_menu_bgr_sel"])!="") { echo $OptionsVis["cat_menu_bgr_sel"]." !important;"; } else { echo "inherit"; } ?>;
}
.dbl-box-shadow {
	box-shadow: 0 4px 10px 0 rgba(160, 160, 160, 0.2), 0 4px 10px 0 rgba(160, 160, 160, 0.19);
}
.dbl-image-wrapper-grid {
	display:block;
	overflow:hidden;
}
.dbl-image-grid {
	position: relative;
	width: 100%;
 	<?php 
	//if($OptionsVis["summ_image_ratio"]=="43") {
	//	$ratio = 75;
	//} elseif($OptionsVis["summ_image_ratio"]=="169") {
	//	$ratio = 56;
	//} else {
		$ratio = 75;
	//} 
	?>  
	padding-bottom : <?php echo $OptionsVis["thumb_ratio"]; ?>%; /* = width for a 1:1 aspect ratio */
	background-position:center center;
	background-repeat:no-repeat;
	background-size:cover; /* you change this to "contain" if you don't want the images to be cropped */
	transition: all .15s ease-in-out;
}
.dbl-image-grid:hover {
	opacity: 0.7;
	transition: all .15s ease-in-out;
	transform: scale(1.1);
	-moz-transform: scale(1.1);
	-webkit-transform: scale(1.1);
	-o-transform: scale(1.1);
	-ms-transform: scale(1.1); /* IE 9 */
	-ms-filter: "progid:DXImageTransform.Microsoft.Matrix(M11=1.5, M12=0, M21=0, M22=1.5, SizingMethod='auto expand')"; /* IE8 */
 	filter: progid:DXImageTransform.Microsoft.Matrix(M11=1.5, M12=0, M21=0, M22=1.5, SizingMethod='auto expand'); /* IE6 and 7 */
}
.margin_bottom6 {
	margin-bottom: 6px;
}
.marg0-padd0 {
	margin:0 !important;
	padding:0 !important;
}
/* div that wraps the grid title and desciption */
.dbl-title-descr-grid {
	padding: 4.4%;
 	background-color: <?php if(trim($OptionsVis["list_text_bgr_color"])!="") { echo $OptionsVis["list_text_bgr_color"]; } else { echo "inherit"; } ?>;
}
/* style for the blog titles in the grid start */
.dbl-title-grid {
 	font-family:<?php echo $OptionsVis["list_title_font"]; ?> !important;
 	color:<?php echo $OptionsVis["list_title_color"]; ?> !important;
 	font-size:<?php echo $OptionsVis["list_title_size"]; ?> !important;
 	font-weight:<?php echo $OptionsVis["list_title_font_weight"]; ?> !important;
 	font-style: <?php echo $OptionsVis["list_title_font_style"]; ?> !important;
 	text-align:<?php echo $OptionsVis["list_title_align"]; ?> !important;
 	line-height: <?php echo $OptionsVis["list_title_line_height"]; ?> !important;
	text-decoration:none !important;
	-webkit-transition: color .1s ease-out;
	transition: color .1s ease-out;
}
/* style for the blog titles in the grid end */
/* style on mouse over for the blog titles in the news grid start */
.dbl-title-grid:hover {
 	font-family:<?php echo $OptionsVis["list_title_font"]; ?> !important;
 	color:<?php echo $OptionsVis["list_title_color_hover"]; ?> !important;
 	font-size:<?php echo $OptionsVis["list_title_size"]; ?> !important;
 	font-weight:<?php echo $OptionsVis["list_title_font_weight"]; ?> !important;
 	font-style: <?php echo $OptionsVis["list_title_font_style"]; ?> !important;
 	text-align:<?php echo $OptionsVis["list_title_align"]; ?> !important;
	text-decoration:none !important;
	-webkit-transition: color .2s ease-out;
	transition: color .2s ease-out;
}
/* style on mouse over for the blog titles in the grid end */


/* distance in the grid title-date */
div.dbl-grid-dist-title-date {
	clear:both !important;
 	height:<?php echo $OptionsVis["list_dist_title_date"]; ?> !important;
}
/* date style in the grid of posts */
div.dbl-grid-date-style {
 	font-family:<?php echo $OptionsVis["list_date_font"]; ?> !important;
 	color:<?php echo $OptionsVis["list_date_color"]; ?> !important;
 	font-size:<?php echo $OptionsVis["list_date_size"]; ?> !important;
 	font-style: <?php echo $OptionsVis["list_date_font_style"]; ?> !important;
 	text-align:<?php echo $OptionsVis["list_date_text_align"]; ?> !important;
	float: left;
}
/* "COMMENTS" link */
a.dbl-comments-num-link {
 	color:<?php echo $OptionsVis["coml_font_color"]; ?> !important;
 	font-family:<?php echo $OptionsVis["coml_font"]; ?> !important;
 	font-size:<?php echo $OptionsVis["coml_font_size"]; ?> !important;
 	font-weight:<?php echo $OptionsVis["coml_font_weight"]; ?> !important;
 	font-style:<?php echo $OptionsVis["coml_font_style"]; ?> !important;
	text-decoration: none !important;
	-webkit-transition: color .3s ease-out;
	transition: color .3s ease-out;
	display: block;
	float: right;
}
/* Comments(number) on mouse over */
a.dbl-comments-num-link:hover {
 	color:<?php echo $OptionsVis["coml_font_color_hover"]; ?> !important;
 	font-family:<?php echo $OptionsVis["coml_font"]; ?> !important;
 	font-size:<?php echo $OptionsVis["coml_font_size"]; ?> !important;
 	font-weight:<?php echo $OptionsVis["coml_font_weight"]; ?> !important;
 	font-style:<?php echo $OptionsVis["coml_font_style"]; ?> !important;
	text-decoration: none !important;
	-webkit-transition: color .3s ease-out;
	transition: color .3s ease-out;
}
/* "COMMENTS" icon */
.dbl-comments-num-link i {
 	color:<?php echo $OptionsVis["coml_font_color"]; ?> !important;
	font-size:<?php echo $OptionsVis["list_date_size"]; ?> !important;
	-webkit-transition: color .3s ease-out;
	transition: color .3s ease-out;
}
/* Comments(number) on mouse over */
.dbl-comments-num-link i:hover {
 	color:<?php echo $OptionsVis["coml_font_color_hover"]; ?> !important;
 	font-size:<?php echo $OptionsVis["coml_font_size"]; ?> !important;
	-webkit-transition: color .3s ease-out;
	transition: color .3s ease-out;
}
div.dbl-grid-dist-date-text {
	clear:both !important;
	height:<?php echo $OptionsVis["list_dist_date_text"]; ?> !important;
	line-height: 0px !important;
}
/* style for the blog short description text start */
.dbl-short-descr {
 	font-family:<?php echo $OptionsVis["list_text_font"]; ?> !important;
 	color: <?php if(trim($OptionsVis["list_text_color"])!="") { echo $OptionsVis["list_text_color"]; } else { echo "inherit"; } ?>;
 	background-color: <?php if(trim($OptionsVis["list_text_bgr_color"])!="") { echo $OptionsVis["list_text_bgr_color"]; } else { echo "inherit"; } ?>;
 	font-size:<?php echo $OptionsVis["list_text_size"]; ?>;
 	font-weight:<?php echo $OptionsVis["list_text_font_weight"]; ?> !important;
 	font-style: <?php echo $OptionsVis["list_text_font_style"]; ?> !important;
 	text-align:<?php echo $OptionsVis["list_text_text_align"]; ?> !important;
 	line-height:<?php echo $OptionsVis["list_text_line_height"]; ?> !important;
	padding: 0 !important;
	margin: 0 !important;
	float: none !important;
	clear: both !important;
}
/* style for the blog short description text end */



/* Distance between posts in the grid - vertical */
div.dist_btw_posts {
	clear:both !important;
 	height: 0 !important;
	margin: 0 !important;
	padding: 0 !important;
	line-height:0 !important;
	font-size:0 !important;

}
/* back link style */
div.back_link {
 	padding-bottom:<?php echo $OptionsVis["dist_link_title"]; ?> !important;
	text-align: left !important;
}
div.back_link a {
 	color:<?php echo $OptionsVis["back_font_color"]; ?> !important;
 	font-size:<?php echo $OptionsVis["back_font_size"]; ?> !important;
 	font-weight:<?php echo $OptionsVis["back_font_weight"]; ?> !important;
 	font-style:<?php echo $OptionsVis["back_font_style"]; ?> !important;
 	text-decoration:<?php echo $OptionsVis["back_text_decoration"]; ?> !important;
}
/* "back link style on mouse over */
div.back_link a:hover {
 	color:<?php echo $OptionsVis["back_font_color_hover"]; ?> !important;
 	font-size:<?php echo $OptionsVis["back_font_size"]; ?> !important;
 	font-weight:<?php echo $OptionsVis["back_font_weight"]; ?> !important;
 	font-style:<?php echo $OptionsVis["back_font_style"]; ?> !important;
 	text-decoration: <?php echo $OptionsVis["back_text_decoration_hover"]; ?> !important;
	-webkit-transition: color .3s ease-out;
	transition: color .3s ease-out;
}
/* title on the full post style */
div.post_title {
 	font-family:<?php echo $OptionsVis["post_title_font"]; ?> !important;
 	color:<?php echo $OptionsVis["post_title_color"]; ?> !important;
 	font-size:<?php echo $OptionsVis["post_title_size"]; ?> !important;
 	font-weight:<?php echo $OptionsVis["post_title_font_weight"]; ?> !important;
 	font-style: <?php echo $OptionsVis["post_title_font_style"]; ?> !important;
 	text-align:<?php echo $OptionsVis["post_title_align"]; ?> !important;
 	line-height: <?php echo $OptionsVis["title_line_height"]; ?> !important;
	text-decoration:none !important;
 	border-bottom: solid <?php echo $OptionsVis["title_line_thick"]; ?> <?php echo $OptionsVis["title_line_color"]; ?> !important;
 	padding-bottom: <?php echo $OptionsVis["title_dist_line"]; ?> !important;
}
div.dist_title_date {
	clear:both !important;
 	height:<?php echo $OptionsVis["dist_title_date"]; ?> !important;
}
/* post date style */
div.date_style {
 	color:<?php echo $OptionsVis["date_color"]; ?> !important;
 	font-family:<?php echo $OptionsVis["date_font"]; ?> !important;
 	font-size:<?php echo $OptionsVis["date_size"]; ?> !important;
 	font-style: <?php echo $OptionsVis["date_font_style"]; ?> !important;
 	text-align:<?php echo $OptionsVis["date_text_align"]; ?> !important;
}
a.aplus-aminus {
	text-decoration:none;
	color:#999;
 font-size:<?php echo $OptionsVis["date_size"];
?>;
}
div.dist_date_text {
	clear:both !important;
 	height:<?php echo $OptionsVis["dist_date_text"]; ?> !important;
}
/* post text style */
div.post_text {
 	font-family:<?php echo $OptionsVis["text_font"]; ?> !important;
 	color:<?php echo $OptionsVis["text_color"]; ?> !important;
 	background-color: <?php echo $OptionsVis["text_bgr_color"]; ?> !important;
 	font-size:<?php echo $OptionsVis["text_size"]; ?>;
 	font-weight:<?php echo $OptionsVis["text_font_weight"]; ?> !important;
 	font-style: <?php echo $OptionsVis["text_font_style"]; ?> !important;
 	text-align:<?php echo $OptionsVis["text_text_align"]; ?> !important;
 	line-height:<?php echo $OptionsVis["text_line_height"]; ?> !important;
 	padding: 0 <?php echo $OptionsVis["text_padding"]; ?> !important;
	margin: 0 !important;
}
/* post text images style */
div.post_text img {
	max-width: 100% !important;
	height: auto !important;
}
/* post text iframe style */
div.post_text iframe {
	max-width: 100% !important;
}
/* links style in the post text */
div.post_text a {
 	color: <?php echo $OptionsVis["links_font_color"]; ?> !important;
 	text-decoration: <?php echo $OptionsVis["links_text_decoration"]; ?> !important;
 	font-size: <?php echo $OptionsVis["links_font_size"]; ?> !important;
 	font-style: <?php echo $OptionsVis["links_font_style"]; ?> !important;
 	font-weight: <?php echo $OptionsVis["links_font_weight"]; ?> !important;
}
/* links style in the post text on mouse over */
div.post_text a:hover {
 	color: <?php echo $OptionsVis["links_font_color_hover"]; ?> !important;
 	text-decoration: <?php echo $OptionsVis["links_text_decoration_hover"]; ?> !important;
 	font-size: <?php echo $OptionsVis["links_font_size"]; ?> !important;
 	font-style: <?php echo $OptionsVis["links_font_style"]; ?> !important;
 	font-weight: <?php echo $OptionsVis["links_font_weight"]; ?> !important;
	-webkit-transition: color .3s ease-out;
	transition: color .3s ease-out;
}
/* share buttons style */
div.share_buttons {
	padding-top:6px !important;
 	float: <?php echo $Options["share_side"]; ?> !important;
}
/* comment message style */
div.comment_message {
	padding:10px !important;
	color:red !important;
	font-weight:bold !important;
	text-align: left !important;
}
/* style for word "Comments" above the list of comments */
div.word_Comments {
	padding-bottom:10px !important;
 	font-family:<?php echo $OptionsVisC["w_comm_font_family"]; ?> !important;
 	color:<?php echo $OptionsVisC["w_comm_font_color"]; ?> !important;
 	font-size:<?php echo $OptionsVisC["w_comm_font_size"]; ?> !important;
 	font-style:<?php echo $OptionsVisC["w_comm_font_style"]; ?> !important;
 	font-weight:<?php echo $OptionsVisC["w_comm_font_weight"]; ?> !important;
	text-align:left !important;
}
/* comment listing and comments form style */
.comments_wrapper {
	background-color:<?php echo $OptionsVisC["comm_bgr_color"]; ?> !important;
 	padding:<?php echo $OptionsVisC["comm_padding"]; ?> <?php echo $OptionsVisC["comm_padd_dim"]; ?> !important;
	
 	<?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='top_bottom' or $OptionsVisC["comm_bord_sides"]=='top') { ?> border-top:<?php echo $OptionsVisC["comm_bord_style"]." ".$OptionsVisC["comm_bord_width"]." ".$OptionsVisC["comm_bord_color"]; ?> !important;
 	<?php } else { ?>
	border-top: 0 !important;
 	<?php } ?>  
	
	<?php  if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='top_bottom' or $OptionsVisC["comm_bord_sides"]=='bottom') {
?>
	border-bottom:<?php echo $OptionsVisC["comm_bord_style"]." ".$OptionsVisC["comm_bord_width"]." ".$OptionsVisC["comm_bord_color"]; ?> !important;
	<?php } else { ?>
	border-bottom: 0 !important;
 	<?php } ?>
	
	<?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='right_left' or $OptionsVisC["comm_bord_sides"]=='left') {
?>
	border-left:<?php echo $OptionsVisC["comm_bord_style"]." ".$OptionsVisC["comm_bord_width"]." ".$OptionsVisC["comm_bord_color"]; ?> !important;
 	<?php } else { ?>  
	border-left: 0 !important;
 	<?php } ?>
	
	<?php if($OptionsVisC["comm_bord_sides"]=='all' or $OptionsVisC["comm_bord_sides"]=='right_left' or $OptionsVisC["comm_bord_sides"]=='right') {
?>  border-right:<?php echo $OptionsVisC["comm_bord_style"]." ".$OptionsVisC["comm_bord_width"]." ".$OptionsVisC["comm_bord_color"];
?> !important;
 	<?php } else { ?>  
	border-right: 0 !important;
 	<?php } ?>
}
table.comments_wrapper {
	width: 100% !important;
}
table.comments_wrapper tr {
	background: none !important;
}
table.comments_wrapper td {
	padding: 8px 6px !important;
	margin:0 !important;
	border: 0 !important;
}
.dbl-comments-name {
 	color:<?php echo $OptionsVisC["name_font_color"]; ?>;
 	font-size:<?php echo $OptionsVisC["name_font_size"]; ?>;
 	font-style:<?php echo $OptionsVisC["name_font_style"]; ?>;
 	font-weight:<?php echo $OptionsVisC["name_font_weight"]; ?>;
	float:left;
	padding-bottom:8px;
}
.dbl-commentNum {
	float:right;
	padding-left:10px;
}
.dbl-commentNum span {
	font-weight:bold;
	padding-right:2px;
}
.dbl-comments-date {
 	color:<?php echo $OptionsVisC["comm_date_color"]; ?>;
 	font-family:<?php echo $OptionsVisC["comm_date_font"]; ?>;
 	font-size:<?php echo $OptionsVisC["comm_date_size"]; ?>;
 	font-style: <?php echo $OptionsVisC["comm_date_font_style"]; ?>;
	float:right;
}
.dbl-comments-text {
	color:<?php echo $OptionsVisC["comm_font_color"]; ?>;
	font-size:<?php echo $OptionsVisC["comm_font_size"]; ?>;
	font-style:<?php echo $OptionsVisC["comm_font_style"]; ?>;
	font-weight:<?php echo $OptionsVisC["comm_font_weight"]; ?>;
	text-align: left !important;
}
.dbl-dist-btw-comm {
	clear:both;
 	height:<?php echo $OptionsVisC["dist_btw_comm"]; ?>;
}
.dbl-no-comments-posted {
	padding-bottom:10px;
	padding-top:10px;
	font-weight:bold;
	clear:both;
	text-align: left !important;
}
/* "Leave a Comment" style */
table.comments_wrapper td.leave_comment {
	color:<?php echo $OptionsVisC["leave_font_color"]; ?> !important;
	font-size:<?php echo $OptionsVisC["leave_font_size"]; ?> !important;
	font-weight:<?php echo $OptionsVisC["leave_font_weight"]; ?> !important;
	font-style:<?php echo $OptionsVisC["leave_font_style"]; ?> !important;
	text-align: left !important;
	background-color: transparent !important;
}
/* comments form labels style */
table.comments_wrapper td.comment_labels {
	text-align: left !important;
	padding:6px;
	color:<?php echo $OptionsVisC["field_font_color"]; ?> !important;
	font-size:<?php echo $OptionsVisC["field_font_size"]; ?> !important;
	font-weight:<?php echo $OptionsVisC["field_font_weight"]; ?> !important;
	font-style:<?php echo $OptionsVisC["field_font_style"]; ?> !important;
}
/* comments form fields style */
table.comments_wrapper td.comment_fields {
	text-align: left !important;
	background-color: transparent !important;
}
/* comments form label required field style */
table.comments_wrapper td.comment_required {
	padding-left:<?php echo $OptionsVisC["comm_padding"]; ?> !important;
	color:<?php echo $OptionsVisC["req_font_color"]; ?> !important;
	font-size:<?php echo $OptionsVisC["req_font_size"]; ?> !important;
	padding-top:0 !important;
	padding-bottom:20px !important;
	text-align: left !important;
}
/* comment form fields style */
.form_fields {
	color: #000000 !important;
	background-color: #FFFFFF !important;
	font-family: Helvetica !important;
	font-size: 16px !important;
	font-weight: normal !important;
	font-style: normal !important;
	padding:1.5% !important;
	border: solid 1px #dadada !important;
	border-radius: 0px !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	margin: 0 !important;
	width: 100%;
	height: auto !important;
}
.form_fields:focus, .searchinput:active {
	border: solid 1px #03A9F4 !important;
}

/* comment form fields placeholder style */
.form_fields::-webkit-input-placeholder {
 	color: #767676 !important;
}
.form_fields:-moz-placeholder { /* Firefox 18- */
 	color: #767676 !important;
}
.form_fields::-moz-placeholder {  /* Firefox 19+ */
 	color: #767676 !important;
}
.form_fields:-ms-input-placeholder {
 	color: #767676 !important;
}
.form_textarea {
	font-size: 14px !important;
	font-weight: normal !important;
	font-style: normal !important;
	width:95% !important;
	display:block !important;
	float:left !important;
}
.form_field_50 {
	width:50% !important;
}
.form_field_95 {
	width:95% !important;
	display:block !important;
	float:left !important;
}
.form_field_100 {
	width:100% !important;
}
.form_field_96 {
	width:96% !important;
}
td.comment_button {
	text-align: left !important;
	background: none !important;
}
/* Submit button*/
.submitbtn {
	color:<?php echo $OptionsVisC["subm_color"]; ?> !important;
	font-size:14px !important;
	font-weight:<?php echo $OptionsVisC["subm_font_weight"]; ?> !important;
	font-style:<?php echo $OptionsVisC["subm_font_style"]; ?> !important;
	border:1px solid <?php echo $OptionsVisC["subm_brdr_color"]; ?> !important;
	background-color: <?php echo $OptionsVisC["subm_bgr_color"]; ?> !important;
	border-radius:<?php echo $OptionsVisC["subm_bor_radius"]; ?> !important;
	-webkit-border-radius:<?php echo $OptionsVisC["subm_bor_radius"]; ?> !important;
	-moz-border-radius:<?php echo $OptionsVisC["subm_bor_radius"]; ?> !important;
	-khtml-border-radius: <?php echo $OptionsVisC["subm_bor_radius"]; ?> !important;
	text-indent:0 !important;
	background-image: none !important;
	cursor: pointer !important;
	display:inline-block !important;
	text-decoration:none !important;
	text-shadow: none !important;
	text-align:center !important;
	padding: 10px 38px !important;
	-webkit-transition: border-color .3s ease-out, color .3s ease-out, background-color .3s ease-out; /* Safari */
	transition: border-color .3s ease-out, color .3s ease-out, background-color .3s ease-out;
	letter-spacing: 1px;
}
.submitbtn:hover {
	color: <?php echo $OptionsVisC["subm_brdr_color"]; ?> !important;
	background-color:<?php echo $OptionsVisC["subm_bgr_color_on"]; ?> !important;
	-webkit-transition: border-color .3s ease-out, color .3s ease-out, background-color .3s ease-out; /* Safari */
	transition: border-color .3s ease-out, color .3s ease-out, background-color .3s ease-out;
}
/* navigation at the bottom style */

table.bottom_navigator {
	width:100% !important;
	border:0 !important;
	border-collapse: collapse !important;
	border-spacing: 0 !important;
	background: none !important;
}
table.bottom_navigator td {
 padding: <?php echo $OptionsVis["dist_comm_links"];
?> 16px 0 16px !important;
	width: 33% !important;
	border: 0 !important;
}
table.bottom_navigator td.older_post {
	text-align: left !important;
	background: none !important;
}
table.bottom_navigator td.home_post {
	text-align: center !important;
	background: none !important;
}
table.bottom_navigator td.newer_post {
	text-align: right !important;
	background: none !important;
}
/*  navigation at the bottom "Older Post", "Home", "Newer Post" links style */

a.nav_active {
	color:<?php echo $OptionsVis["bott_color"]; ?> !important;
	font-size:<?php echo $OptionsVis["bott_size"]; ?> !important;
	font-style:<?php echo $OptionsVis["bott_style"]; ?> !important;
	font-weight:<?php echo $OptionsVis["bott_weight"]; ?> !important;
	text-decoration:<?php echo $OptionsVis["bott_decoration"]; ?> !important;
}
/*  navigation at the bottom "Older Post", "Home", "Newer Post" links on hover */

a.nav_active:hover {
	color:<?php echo $OptionsVis["bott_color_hover"]; ?> !important;
	font-size:<?php echo $OptionsVis["bott_size"]; ?> !important;
	font-style:<?php echo $OptionsVis["bott_style"]; ?> !important;
	font-weight:<?php echo $OptionsVis["bott_weight"]; ?> !important;
	text-decoration: <?php echo $OptionsVis["bott_decoration_hover"]; ?> !important;
	-webkit-transition: color .3s ease-out;
	transition: color .3s ease-out;
}
/*  navigation at the bottom "Older Post", "Home", "Newer Post" links inactive */

.nav_inactive {
	color:<?php echo $OptionsVis["bott_color_inact"]; ?> !important;
	font-size:<?php echo $OptionsVis["bott_size"]; ?> !important;
	font-style:<?php echo $OptionsVis["bott_style"]; ?> !important;
	font-weight:<?php echo $OptionsVis["bott_weight"]; ?> !important;
	text-decoration: none;
}
/* captcha image fields styles start */

.form_captcha {
	color: #000000 !important;
	background-color: #FFF !important;
	font-family: Helvetica !important;
	font-size: 16px !important;
	font-weight: normal !important;
	font-style: normal !important;
	padding:5px;
	border: solid 1px #dadada !important;
	border-radius: 0px !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	margin: 0 !important;
}
.form_captcha:focus, .form_captcha:active {
	border: solid 1px #03A9F4 !important;
}
.form_captcha_img {
	display:block;
	float:left;
}
.form_captcha_eq {
	float:left;
	padding-top:9px;
	padding-left:3px;
	padding-right:3px;
	font-size:20px;
	color:#666;
	font-weight:bold;
}
.form_captcha_math {
	width:40px;
	display:block;
	float:left;
	margin-top:4px;
	height:28px;
	font-size:17px;
	text-align:center;
}
.form_captcha_s {
	width:66px;
	height:23px;
	display:block;
	float:left;
	margin-left:10px !important;
}
.form_asterisk {
	float:left;
	padding-left:5px;
	padding-top:10px;
}
/* make google reCaptcha responsive width */	

.recaptchatable {
	max-width: 100% !important;
}
.recaptcha_theme_clean {
	width:auto !important;
}
 @media (min-width: 320px) and (max-width: 480px) {
	#recaptcha_challenge_image {
		margin: 0 !important;
		width: 100% !important;
	}
	#recaptcha_response_field {
		margin: 0 !important;
		width: 100% !important;
	}
	.recaptchatable #recaptcha_image {
		margin: 0 !important;
		width: 100% !important;
	}
	.recaptchatable .recaptcha_r1_c1,  .recaptchatable .recaptcha_r3_c1,  .recaptchatable .recaptcha_r3_c2,  .recaptchatable .recaptcha_r7_c1,  .recaptchatable .recaptcha_r8_c1,  .recaptchatable .recaptcha_r3_c3,  .recaptchatable .recaptcha_r2_c1,  .recaptchatable .recaptcha_r4_c1,  .recaptchatable .recaptcha_r4_c2,  .recaptchatable .recaptcha_r4_c4,  .recaptchatable .recaptcha_image_cell {
		margin: 0 !important;
		width: 100% !important;
		background: none !important;
	}
}
/* captcha image fields styles ends */	



/* Pagination */
.page_numbers_sel {
	color: <?php if(trim($OptionsVis["pag_font_color_sel"])!="") { echo $OptionsVis["pag_font_color_sel"]." !important"; } else { echo "inherit"; } ?>;
	background-color:<?php if(trim($OptionsVis["pag_bgr_color_sel"])!="") { echo $OptionsVis["pag_bgr_color_sel"]." !important"; } else { echo "inherit"; } ?>;
	font-family: <?php echo $OptionsVis["pag_font_family"]; ?>;
	font-size:<?php echo $OptionsVis["pag_font_size"]; ?>;
	font-weight:<?php echo $OptionsVis["pag_font_weight"]; ?>;
	font-style:<?php echo $OptionsVis["pag_font_style"]; ?>;
}
.page_numbers {
	color:<?php if(trim($OptionsVis["pag_font_color"])!="") { echo $OptionsVis["pag_font_color"]." !important"; } else { echo "inherit"; } ?>;
	background-color:<?php if(trim($OptionsVis["pag_bgr_color"])!="") { echo $OptionsVis["pag_bgr_color"]." !important"; } else { echo "inherit"; } ?>;
}
.page_numbers:hover {
	color:<?php if(trim($OptionsVis["pag_font_color_hover"])!="") { echo $OptionsVis["pag_font_color_hover"]." !important"; } else { echo "inherit"; } ?>;
	background-color:<?php if(trim($OptionsVis["pag_bgr_color_hover"])!="") { echo $OptionsVis["pag_bgr_color_hover"]." !important"; } else { echo "inherit"; } ?>;
}



/* scroll to top styles */

.cd-top {
	display: inline-block;
 	width: <?php echo $OptionsVis["scrolltop_width"]; ?>;
 	height: <?php echo $OptionsVis["scrolltop_height"]; ?>;
	position: fixed;
	bottom: 40px;
	right: 10px;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
	/* image replacement properties */

	overflow: hidden;
	text-indent: 100%;
	white-space: nowrap;
 	background: <?php echo $OptionsVis["scrolltop_bgr_color"]; ?> url(<?php echo $CONFIG["full_url"]; ?>images/cd-top-arrow.svg) no-repeat center 50%;
	visibility: hidden;
	opacity: 0;
	-webkit-transition: opacity .3s 0s, visibility 0s .3s;
	-moz-transition: opacity .3s 0s, visibility 0s .3s;
	transition: opacity .3s 0s, visibility 0s .3s;
	z-index: 9999;
 	-webkit-border-radius: <?php echo $OptionsVis["scrolltop_radius"]; ?> !important;
 	-moz-border-radius: <?php echo $OptionsVis["scrolltop_radius"]; ?> !important;
 	border-radius: <?php echo $OptionsVis["scrolltop_radius"]; ?> !important;
}
.cd-top.cd-is-visible, .cd-top.cd-fade-out, .cd-top:hover {
	-webkit-transition: opacity .3s 0s, visibility 0s 0s;
	-moz-transition: opacity .3s 0s, visibility 0s 0s;
	transition: opacity .3s 0s, visibility 0s 0s;
}
.cd-top:hover {
 	background-color: <?php echo $OptionsVis["scrolltop_bgr_color_hover"]; ?>;
}
.cd-top.cd-is-visible {
	/* the button becomes visible */
	visibility: visible;
	-khtml-opacity:<?php echo $OptionsVis["scrolltop_opacity"]/100; ?>;
	-moz-opacity:<?php echo $OptionsVis["scrolltop_opacity"]/100; ?>;
	filter: progid:DXImageTransform.Microsoft.Alpha(opacity=<?php echo $OptionsVis["scrolltop_opacity"]/100; ?>);
	opacity: <?php echo $OptionsVis["scrolltop_opacity"]/100; ?>;
	filter:alpha(opacity=<?php echo $OptionsVis["scrolltop_opacity"]; ?>);
}
.cd-top.cd-fade-out {
	/* if the user keeps scrolling down, the button is out of focus and becomes less visible */
	-khtml-opacity:<?php echo $OptionsVis["scrolltop_opacity_hover"]/100; ?>;
	-moz-opacity:<?php echo $OptionsVis["scrolltop_opacity_hover"]/100; ?>;
	filter: progid:DXImageTransform.Microsoft.Alpha(opacity=<?php echo $OptionsVis["scrolltop_opacity_hover"]/100; ?>);
	opacity: <?php echo $OptionsVis["scrolltop_opacity_hover"]/100; ?>;
	filter:alpha(opacity=<?php echo $OptionsVis["scrolltop_opacity_hover"]; ?>);
}
@media only screen and (min-width: 768px) {
	.cd-top {
		right: 20px;
		bottom: 20px;
	}
}
@media only screen and (min-width: 1024px) {
	.cd-top {
		width: <?php echo $OptionsVis["scrolltop_width"]; ?>;
		height: <?php echo $OptionsVis["scrolltop_height"]; ?>;
		right: 30px;
		bottom: 30px;
	}
}
/* scroll to top style end */



/* clear float div recurring */

div.dist_search_title {
	clear:both !important;
	height:0 !important;
	line-height:0 !important;
	font-size:0 !important;
	padding:0;
	margin:0 !important;
 	padding-bottom: <?php echo $OptionsVis["dist_search_title"]; ?> !important;
}
blockquote {
	background: #f9f9f9;
	border-left: 10px solid #ccc;
	margin: 1.5em 10px;
	padding: 0.5em 10px;
	quotes: "\201C""\201D""\2018""\2019";
}
blockquote:before {
	color: #ccc;
	content: open-quote;
	font-size: 4em;
	line-height: 0.1em;
	margin-right: 0.25em;
	vertical-align: -0.4em;
}
blockquote p {
	display: inline;
}
.textAlignLeft {
	text-align: left !important;
}
</style>
