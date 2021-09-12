<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
    </a>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#">
        <i class="la lar la-boxes"></i> Item Configurations
    </a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('item/group') }}'>
                <i class='nav-icon la la-layer-group'></i> Groups
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('item/brand') }}'>
                <i class='nav-icon la la-copyright'></i> Brands
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('item/item') }}'>
                <i class='nav-icon la la-box'></i> Items
            </a>
        </li>
        <li class='nav-item'>
            <a class='nav-link' href='{{ backpack_url('item/itemTag') }}'>
                <i class='nav-icon la la-box'></i> Item Tag
            </a>
        </li>
    </ul>
</li>
