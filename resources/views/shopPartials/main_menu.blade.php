<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <!-- <li><a href="{{ route('home') }}" class="active">Home</a></li> -->
        <!-- <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
            <ul role="menu" class="sub-menu">
                <li><a href="shop.html">Products</a></li>
                <li><a href="checkout.html">Checkout</a></li>
                <li><a href="cart.html">Cart</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="login.html">Register</a></li>
            </ul>
        </li> -->

        @foreach($menusParent as $menu)
        <li class="{{ $menu->children->isNotEmpty() ? 'dropdown' : '' }}">
            <a href="{{ $menu->url ? route($menu->url) : '#' }}" class="{{ $menu->children->isNotEmpty() ? '' : 'active' }}">
                {{ $menu->name }}
                @if($menu->children->isNotEmpty())
                <i class="fa fa-angle-down"></i>
                @endif
            </a>
            @if($menu->children->isNotEmpty())
            <ul role="menu" class="sub-menu">
                @foreach($menu->children as $child)
                <li><a href="{{ $child->url ? route($child->url) : '#' }}">{{ $child->name }}</a></li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach

        <!-- <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
            <ul role="menu" class="sub-menu">
                <li><a href="blog.html">Blog List</a></li>
                <li><a href="blog-single.html">Blog Single</a></li>
            </ul>
        </li>
        <li><a href="contact-us.html">Contact</a></li>
        <li><a href="contact-us.html">About Us</a></li> -->
    </ul>
</div>