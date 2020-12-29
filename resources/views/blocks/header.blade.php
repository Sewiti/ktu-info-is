<header class="header trans_300">
  <div class="top_nav">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="top_nav_left">Įvairios elektronikos taisykla ir dalių parduotuvė</div>
        </div>
        <div class="col-md-6 text-right">
          <div class="top_nav_right">
            <ul class="top_nav_menu">
              {{-- <li class="language">
                <a href="#">
                  Lietuvių<i class="fa fa-angle-down"></i>
                </a>
                <ul class="language_selection">
                  <li><a href="#">Lietuvių</a></li>
                  <li><a href="#">English</a></li>
                </ul>
              </li> --}}
              @role('Administratorius')
              <li class="account">
                <a href="{{ route('users.index') }}">Vartotojai</a>
              </li>
              @endrole
              <li class="account">
                @guest
                <a href="#" onclick="event.preventDefault()">
                  <i class="fa fa-user"></i> Mano paskyra<i class="fa fa-angle-down"></i>
                </a>
                <ul class="account_selection">
                  <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>Prisijungti</a>
                  </li>
                  <li><a href="{{ route('register') }}"><i class="fa fa-user-plus"
                        aria-hidden="true"></i>Registruotis</a></li>
                </ul>
                @else
                <a href="#" onclick="event.preventDefault()">
                  @switch(Auth::user()->vartotojo_tipas)
                  @case(2)
                  <i class="fa fa-briefcase"></i>
                  @break
                  @case(3)
                  <i class="fa fa-shield"></i>
                  @break
                  @default
                  <i class="fa fa-user"></i>
                  @endswitch
                  {{ Auth::user()->vardas }}
                  {{ Auth::user()->pavarde }}
                  <i class="fa fa-angle-down"></i>
                </a>
                <ul class="account_selection">
                  <li>
                    <a href="{{ route('users.show', ['userId'=>Auth::user()->id]) }}">
                      <i class="fa fa-user" aria-hidden="true"></i>Profilis
                    </a>
                  </li>
                  {{-- <li>
                      <a href="{{ route('users.invite') }}">
                  <i class="fa fa-user-plus" aria-hidden="true"></i>Pakviesti
                  </a>
              </li> --}}
              <li>
                <a href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out" aria-hidden="true"></i>Atsijungti
                </a>
              </li>
            </ul>
            @endguest
            </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Navigation -->

  <div class="main_nav_container">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-right">
          <div class="logo_container">
            <a href="{{ route('home') }}">Elektronikos<span>taisykla</span></a>
          </div>
          <nav class="navbar">
            <ul class="navbar_menu">
              <li><a href="{{ route('home') }}">Pradinis</a></li>
              <li><a href="{{ url('/prekes') }}">Prekės</a></li>
              @auth
              <li><a href="{{ url('/paslaugos') }}">Rezervacijos</a></li>
              <li><a href="{{ route('kalendorius.showCalendar') }}">Kalendorius</a></li>
              <li><a href="{{ route('uzsakymai.index') }}">Užsakymai</a></li>
              @endauth
              <li><a href="{{ route('busena.index') }}">Sekimas</a></li>
              {{-- @role('Administratorius')
                <li><a href="{{ route('users.index') }}">Vartotojai</a></li>
              @endrole --}}
              {{-- <li><a href="{{ url('/kontaktai') }}">Kontaktai</a></li> --}}
            </ul>
            <ul class="navbar_user">
              <li>
                @guest
                <a href="{{ route('register') }}">
                  @else
                  <a href="{{ route('users.show', ['userId'=>Auth::user()->id]) }}">
                    @endguest
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                  </a>
              </li>
              <li class="checkout">
                <a href="{{ url('/krepselis') }}">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                  <span id="checkout_items"
                    class="checkout_items">{{ \Illuminate\Support\Facades\Session::has('cart') ? count(\Illuminate\Support\Facades\Session::get('cart')[0]->items) : 0 }}</span>
                </a>
              </li>
            </ul>
            <div class="hamburger_container">
              <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="fs_menu_overlay"></div>

<div class="hamburger_menu">
  <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
  <div class="hamburger_menu_content text-right">
    <ul class="menu_top_nav">
      {{-- <li class="menu_item has-children">
          <a href="#">
              Lietuvių<i class="fa fa-angle-down"></i>
          </a>
          <ul class="menu_selection">
              <li><a href="#">Lietuvių</a></li>
              <li><a href="#">English</a></li>
          </ul>
      </li> --}}
      <li class="menu_item has-children">
        @guest
        <a href="#" onclick="event.preventDefault()">
          Mano paskyra<i class="fa fa-angle-down"></i>
        </a>
        <ul class="menu_selection">
          <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Prisijungti</a></li>
          <li><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Registruotis</a></li>
        </ul>
        @else
        <a href="#" onclick="event.preventDefault()">
          @switch(Auth::user()->vartotojo_tipas)
          @case(2)
          <i class="fa fa-briefcase"></i>
          @break
          @case(3)
          <i class="fa fa-shield"></i>
          @break
          @default
          <i class="fa fa-user"></i>
          @endswitch
          {{ Auth::user()->vardas }}
          {{ Auth::user()->pavarde }}
          <i class="fa fa-angle-down"></i>
        </a>
        <ul class="menu_selection">
          <li>
            <a href="{{ route('users.show', ['userId'=>Auth::user()->id]) }}">
              <i class="fa fa-user" aria-hidden="true"></i>Profilis
            </a>
          </li>
          {{-- <li>
              <a href="{{ route('users.invite') }}">
          <i class="fa fa-user-plus" aria-hidden="true"></i>Pakviesti
          </a>
      </li> --}}
      <li>
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out" aria-hidden="true"></i>Atsijungti
        </a>
      </li>
    </ul>
    @endguest
    </li>
    <li class="menu_item"><a href="{{ url('/') }}">Pradinis</a></li>
    <li class="menu_item"><a href="{{ url('/prekes') }}">Prekės</a></li>
    @auth
    <li class="menu_item"><a href="{{ url('/paslaugos') }}">Rezervacijos</a></li>
    <li class="menu_item"><a href="{{ route('kalendorius.showCalendar') }}">Kalendorius</a></li>
    <li class="menu_item"><a href="{{ route('uzsakymai.index') }}">Užsakymai</a></li>
    @endauth
    <li class="menu_item"><a href="{{ route('busena.index') }}">Sekimas</a></li>
    @role('Administratorius')
    <li class="menu_item"><a href="{{ route('users.index') }}">Vartotojai</a></li>
    @endrole
    {{-- <li class="menu_item"><a href="{{ url('/kontaktai') }}">Kontaktai</a></li> --}}
    </ul>
  </div>
</div>


<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
  @csrf
</form>
