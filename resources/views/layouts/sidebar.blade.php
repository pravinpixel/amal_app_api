<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="" style="background-color:#293A83">
            <img alt="Logo" src="{{ asset('images/Group.png') }}"
                class="h-50px app-sidebar-logo-default theme-light-show" />
            <img alt="Logo" src="{{ asset('images/Group.png') }}"
                class="h-50px app-sidebar-logo-default theme-dark-show" />
            <img alt="Logo" src="{{ asset('images/Group.png') }}" class="h-20px app-sidebar-logo-minimize" />
        </a>
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid"
        style=" background-color: #7dc0e7;background-image: linear-gradient(62deg,#293A83 24%,#7dc0e7 79%);">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item">
                    <a style="" class="menu-link {{(request()->is('dashboard*')) ? 'active' : '' }}"
                        href="{{url('dashboard')}}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="800px" height="800px" viewBox="0 0 20 20" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                    <title>file_favorite [#1609]</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs>

                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-140.000000, -1879.000000)"
                                            fill="#000000">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <path
                                                    d="M97.946,1730.781 L96.806,1731.892 C96.628,1732.066 96.546,1732.316 96.588,1732.561 L96.858,1734.131 C96.941,1734.619 96.553,1735.016 96.113,1735.016 C95.997,1735.016 95.877,1734.988 95.761,1734.927 L94.352,1734.186 C94.242,1734.129 94.121,1734.1 94,1734.1 C93.879,1734.1 93.758,1734.129 93.648,1734.186 L92.239,1734.927 C92.123,1734.988 92.003,1735.016 91.887,1735.016 C91.447,1735.016 91.058,1734.619 91.142,1734.131 L91.411,1732.561 C91.454,1732.316 91.372,1732.066 91.194,1731.892 L90.054,1730.781 C89.605,1730.344 89.853,1729.582 90.473,1729.492 L92.048,1729.263 C92.295,1729.227 92.507,1729.073 92.618,1728.849 L93.322,1727.422 C93.461,1727.141 93.73,1727 94,1727 C94.27,1727 94.539,1727.141 94.678,1727.422 L95.382,1728.849 C95.493,1729.073 95.705,1729.227 95.951,1729.263 L97.527,1729.492 C98.147,1729.582 98.395,1730.344 97.946,1730.781 L97.946,1730.781 Z M102,1736 C102,1736.552 101.552,1737 101,1737 L87,1737 C86.448,1737 86,1736.552 86,1736 L86,1722 C86,1721.448 86.448,1721 87,1721 L96,1721 L96,1725 C96,1726.105 96.895,1727 98,1727 L102,1727 L102,1736 Z M103.707,1724.707 L98.293,1719.293 C98.105,1719.106 97.851,1719 97.586,1719 L86,1719 C84.895,1719 84,1719.896 84,1721 L84,1737 C84,1738.105 84.895,1739 86,1739 L102,1739 C103.105,1739 104,1738.105 104,1737 L104,1725.414 C104,1725.149 103.895,1724.895 103.707,1724.707 L103.707,1724.707 Z"
                                                    id="file_favorite-[#1609]">

                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span style="color: white" class="menu-title">Dashboard</span>
                    </a>
                </div>
                @php
                    $name = Auth::user()->role->name;
                @endphp
                @if($name == 'Super Admin')
                    <div class="menu-item">
                        <a class="menu-link {{(request()->is('user*')) ? 'active' : '' }}" href="{{url('user')}}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                    </svg>
                                </span>
                            </span>
                            <span style="color: white" class="menu-title">User</span>
                        </a>
                    </div>
                @endif
                <div class="menu-item">
                    <a class="menu-link {{(request()->is('student/register-list*')) ? 'active' : '' }}"
                        href="{{url('student/register-list')}}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="800px" height="800px" viewBox="-3 0 20 20" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                    <title>fileboard_checklist [#1595]</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs>

                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-303.000000, -1919.000000)"
                                            fill="#000000">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <path
                                                    d="M258,1774 L258,1774 C258,1774.552 257.552,1775 257,1775 L254,1775 C253.448,1775 253,1774.552 253,1774 C253,1773.448 253.448,1773 254,1773 L257,1773 C257.552,1773 258,1773.448 258,1774 L258,1774 Z M258,1771 L258,1771 C258,1771.552 257.552,1772 257,1772 L254,1772 C253.448,1772 253,1771.552 253,1771 C253,1770.448 253.448,1770 254,1770 L257,1770 C257.552,1770 258,1770.448 258,1771 L258,1771 Z M258,1768 C258,1768.552 257.552,1769 257,1769 L254,1769 C253.448,1769 253,1768.552 253,1768 C253,1767.448 253.448,1767 254,1767 L257,1767 C257.552,1767 258,1767.448 258,1768 L258,1768 Z M252,1774 L252,1774 C252,1774.552 251.552,1775 251,1775 C250.448,1775 250,1774.552 250,1774 C250,1773.448 250.448,1773 251,1773 C251.552,1773 252,1773.448 252,1774 L252,1774 Z M252,1771 L252,1771 C252,1771.552 251.552,1772 251,1772 C250.448,1772 250,1771.552 250,1771 C250,1770.448 250.448,1770 251,1770 C251.552,1770 252,1770.448 252,1771 L252,1771 Z M252,1768 C252,1768.552 251.552,1769 251,1769 C250.448,1769 250,1768.552 250,1768 C250,1767.448 250.448,1767 251,1767 C251.552,1767 252,1767.448 252,1768 L252,1768 Z M259,1776 C259,1776.552 258.552,1777 258,1777 L250,1777 C249.448,1777 249,1776.552 249,1776 L249,1763.5 C249,1763.224 249.224,1763 249.5,1763 L250,1763 C250,1764.104 250.895,1765 252,1765 L256,1765 C257.105,1765 258,1764.104 258,1763 L258.5,1763 C258.776,1763 259,1763.224 259,1763.5 L259,1776 Z M252,1762 C252,1761.448 252.448,1761 253,1761 L255,1761 C255.552,1761 256,1761.448 256,1762 C256,1762.552 255.552,1763 255,1763 L253,1763 C252.448,1763 252,1762.552 252,1762 L252,1762 Z M259,1761 L258,1761 C258,1759.895 257.105,1759 256,1759 L252,1759 C250.895,1759 250,1759.895 250,1761 L249,1761 C247.895,1761 247,1761.895 247,1763 L247,1777 C247,1778.104 247.895,1779 249,1779 L259,1779 C260.105,1779 261,1778.104 261,1777 L261,1763 C261,1761.895 260.105,1761 259,1761 L259,1761 Z"
                                                    id="fileboard_checklist-[#1595]">

                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span style="color: white" class="menu-title">Students</span>
                    </a>
                </div>
                <!-- <div class="menu-item">
                    <a class="menu-link {{(request()->is('employee/submitted-gallery*')) ? 'active' : '' }}"
                        href="{{url('employee/submitted-gallery')}}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="800px" height="800px" viewBox="-3 0 20 20" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                    <title>fileboard_checklist [#1595]</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs>

                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-303.000000, -1919.000000)"
                                            fill="#000000">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <path
                                                    d="M258,1774 L258,1774 C258,1774.552 257.552,1775 257,1775 L254,1775 C253.448,1775 253,1774.552 253,1774 C253,1773.448 253.448,1773 254,1773 L257,1773 C257.552,1773 258,1773.448 258,1774 L258,1774 Z M258,1771 L258,1771 C258,1771.552 257.552,1772 257,1772 L254,1772 C253.448,1772 253,1771.552 253,1771 C253,1770.448 253.448,1770 254,1770 L257,1770 C257.552,1770 258,1770.448 258,1771 L258,1771 Z M258,1768 C258,1768.552 257.552,1769 257,1769 L254,1769 C253.448,1769 253,1768.552 253,1768 C253,1767.448 253.448,1767 254,1767 L257,1767 C257.552,1767 258,1767.448 258,1768 L258,1768 Z M252,1774 L252,1774 C252,1774.552 251.552,1775 251,1775 C250.448,1775 250,1774.552 250,1774 C250,1773.448 250.448,1773 251,1773 C251.552,1773 252,1773.448 252,1774 L252,1774 Z M252,1771 L252,1771 C252,1771.552 251.552,1772 251,1772 C250.448,1772 250,1771.552 250,1771 C250,1770.448 250.448,1770 251,1770 C251.552,1770 252,1770.448 252,1771 L252,1771 Z M252,1768 C252,1768.552 251.552,1769 251,1769 C250.448,1769 250,1768.552 250,1768 C250,1767.448 250.448,1767 251,1767 C251.552,1767 252,1767.448 252,1768 L252,1768 Z M259,1776 C259,1776.552 258.552,1777 258,1777 L250,1777 C249.448,1777 249,1776.552 249,1776 L249,1763.5 C249,1763.224 249.224,1763 249.5,1763 L250,1763 C250,1764.104 250.895,1765 252,1765 L256,1765 C257.105,1765 258,1764.104 258,1763 L258.5,1763 C258.776,1763 259,1763.224 259,1763.5 L259,1776 Z M252,1762 C252,1761.448 252.448,1761 253,1761 L255,1761 C255.552,1761 256,1761.448 256,1762 C256,1762.552 255.552,1763 255,1763 L253,1763 C252.448,1763 252,1762.552 252,1762 L252,1762 Z M259,1761 L258,1761 C258,1759.895 257.105,1759 256,1759 L252,1759 C250.895,1759 250,1759.895 250,1761 L249,1761 C247.895,1761 247,1761.895 247,1763 L247,1777 C247,1778.104 247.895,1779 249,1779 L259,1779 C260.105,1779 261,1778.104 261,1777 L261,1763 C261,1761.895 260.105,1761 259,1761 L259,1761 Z"
                                                    id="fileboard_checklist-[#1595]">

                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span style="color: white" class="menu-title">Submitted Gallery View</span>
                    </a>
                </div> -->
                <!-- <div class="menu-item">
                    <a class="menu-link {{(request()->is('employee/short-list*')) ? 'active' : '' }}"
                        href="{{url('employee/short-list')}}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="800px" height="800px" viewBox="-3 0 20 20" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                    <title>fileboard_done [#1584]</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs>

                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-343.000000, -1959.000000)"
                                            fill="#000000">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <path
                                                    d="M299,1803.5 C299,1803.224 298.776,1803 298.5,1803 L298,1803 C298,1804.104 297.105,1805 296,1805 L292,1805 C290.895,1805 290,1804.104 290,1803 L289.5,1803 C289.224,1803 289,1803.224 289,1803.5 L289,1816 C289,1816.552 289.448,1817 290,1817 L298,1817 C298.552,1817 299,1816.552 299,1816 L299,1803.5 Z M292,1802 C292,1802.552 292.448,1803 293,1803 L295,1803 C295.552,1803 296,1802.552 296,1802 C296,1801.448 295.552,1801 295,1801 L293,1801 C292.448,1801 292,1801.448 292,1802 L292,1802 Z M301,1803 L301,1817 C301,1818.104 300.105,1819 299,1819 L289,1819 C287.895,1819 287,1818.104 287,1817 L287,1803 C287,1801.895 287.895,1801 289,1801 L290,1801 C290,1799.895 290.895,1799 292,1799 L296,1799 C297.105,1799 298,1799.895 298,1801 L299,1801 C300.105,1801 301,1801.895 301,1803 L301,1803 Z M296.828,1807.879 C297.219,1808.269 297.219,1808.902 296.828,1809.293 L293.293,1812.828 C291.549,1811.084 291.907,1811.442 291.172,1810.707 C290.781,1810.317 290.781,1809.683 291.172,1809.293 C291.562,1808.902 292.195,1808.902 292.586,1809.293 L293.293,1810 L295.414,1807.879 C295.805,1807.488 296.438,1807.488 296.828,1807.879 L296.828,1807.879 Z"
                                                    id="fileboard_done-[#1584]">

                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span style="color: white" class="menu-title">Shortlisted</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{(request()->is('employee/shortlist-gallery*')) ? 'active' : '' }}"
                        href="{{url('employee/shortlist-gallery')}}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="800px" height="800px" viewBox="-3 0 20 20" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                    <title>fileboard_done [#1584]</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs>

                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-343.000000, -1959.000000)"
                                            fill="#000000">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <path
                                                    d="M299,1803.5 C299,1803.224 298.776,1803 298.5,1803 L298,1803 C298,1804.104 297.105,1805 296,1805 L292,1805 C290.895,1805 290,1804.104 290,1803 L289.5,1803 C289.224,1803 289,1803.224 289,1803.5 L289,1816 C289,1816.552 289.448,1817 290,1817 L298,1817 C298.552,1817 299,1816.552 299,1816 L299,1803.5 Z M292,1802 C292,1802.552 292.448,1803 293,1803 L295,1803 C295.552,1803 296,1802.552 296,1802 C296,1801.448 295.552,1801 295,1801 L293,1801 C292.448,1801 292,1801.448 292,1802 L292,1802 Z M301,1803 L301,1817 C301,1818.104 300.105,1819 299,1819 L289,1819 C287.895,1819 287,1818.104 287,1817 L287,1803 C287,1801.895 287.895,1801 289,1801 L290,1801 C290,1799.895 290.895,1799 292,1799 L296,1799 C297.105,1799 298,1799.895 298,1801 L299,1801 C300.105,1801 301,1801.895 301,1803 L301,1803 Z M296.828,1807.879 C297.219,1808.269 297.219,1808.902 296.828,1809.293 L293.293,1812.828 C291.549,1811.084 291.907,1811.442 291.172,1810.707 C290.781,1810.317 290.781,1809.683 291.172,1809.293 C291.562,1808.902 292.195,1808.902 292.586,1809.293 L293.293,1810 L295.414,1807.879 C295.805,1807.488 296.438,1807.488 296.828,1807.879 L296.828,1807.879 Z"
                                                    id="fileboard_done-[#1584]">

                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span style="color: white" class="menu-title">Shortlisted Gallery View</span>
                    </a>
                </div> -->

                <!-- <div class="menu-item">
                    <a class="menu-link {{(request()->is('employee/final-list*')) ? 'active' : '' }}"
                        href="{{url('employee/final-list')}}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg width="800px" height="800px" viewBox="0 -0.5 21 21" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                    <title>done [#1476]</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs>

                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-219.000000, -400.000000)"
                                            fill="#000000">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <path
                                                    d="M181.9,258 L165.1,258 L165.1,242 L173.5,242 L173.5,240 L163,240 L163,260 L184,260 L184,250 L181.9,250 L181.9,258 Z M170.58205,245.121 L173.86015,248.243 L182.5153,240 L184,241.414 L173.86015,251.071 L173.86015,251.071 L173.8591,251.071 L169.09735,246.536 L170.58205,245.121 Z"
                                                    id="done-[#1476]">

                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span style="color: white" class="menu-title">Finalist</span>
                    </a>
                </div> -->
                <div>
                </div>
            </div>
            <!-- <div class="menu-item">
                <a style="margin-left: 12px;"
                    class="menu-link {{(request()->is('employee/finallist-gallery*')) ? 'active' : '' }}"
                    href="{{url('employee/finallist-gallery')}}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg width="800px" height="800px" viewBox="0 -0.5 21 21" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                <title>done [#1476]</title>
                                <desc>Created with Sketch.</desc>
                                <defs>

                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Dribbble-Light-Preview" transform="translate(-219.000000, -400.000000)"
                                        fill="#000000">
                                        <g id="icons" transform="translate(56.000000, 160.000000)">
                                            <path
                                                d="M181.9,258 L165.1,258 L165.1,242 L173.5,242 L173.5,240 L163,240 L163,260 L184,260 L184,250 L181.9,250 L181.9,258 Z M170.58205,245.121 L173.86015,248.243 L182.5153,240 L184,241.414 L173.86015,251.071 L173.86015,251.071 L173.8591,251.071 L169.09735,246.536 L170.58205,245.121 Z"
                                                id="done-[#1476]">

                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                    </span>
                    <span style="color: white" class="menu-title">Finalist Gallery View</span>
                </a>
            </div> -->


        </div>
    </div>
</div>
