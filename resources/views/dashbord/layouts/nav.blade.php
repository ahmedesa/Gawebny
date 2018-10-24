<!-- BEGIN: Aside Menu -->
<div
id="m_ver_menu"
class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
data-menu-vertical="true"
data-menu-scrollable="false" data-menu-dropdown-timeout="500"
>
<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
	<li class="m-menu__item " aria-haspopup="true" >
		<a  href="{{ url('/dashbord') }}" class="m-menu__link ">
			<i class="m-menu__link-icon flaticon-line-graph"></i>
			<span class="m-menu__link-title">
				<span class="m-menu__link-wrap">
					<span class="m-menu__link-text">
						Dashbord
					</span>
				</span>
			</span>
		</a>
	</li>
	<li class="m-menu__item " aria-haspopup="true" >
		<a  href="{{ url('/dashbord/users') }}" class="m-menu__link ">
			<i class="m-menu__link-icon flaticon-users"></i>
			<span class="m-menu__link-title">
				<span class="m-menu__link-wrap">
					<span class="m-menu__link-text">
					Users										</span>
				</span>
			</span>
		</a>
	</li>
	<li class="m-menu__item " aria-haspopup="true" >
		<a  href="{{ url('/dashbord/setting') }}" class="m-menu__link ">
			<i class="m-menu__link-icon  fa fa-gear "></i>
			<span class="m-menu__link-title">
				<span class="m-menu__link-wrap">
					<span class="m-menu__link-text">

					Settings										</span>
				</span>
			</span>
		</a>
	</li>
	<li class="m-menu__item " aria-haspopup="true" >
		<a  href="{{ url('/dashbord/reports') }}" class="m-menu__link ">
			<i class="m-menu__link-icon fa  fa-ban"></i>
			<span class="m-menu__link-title">
				<span class="m-menu__link-wrap">
					<span class="m-menu__link-text">

						Reports									
					</span>
					@if(\App\Report::where('seen',false)->count() != 0)
					<span class="m-menu__link-badge">
						<span class="m-badge m-badge--danger">
							{{\App\Report::where('seen',false)->count()}}
						</span>
					</span>
					@endif
				</span>
			</span>
		</a>
	</li>
	<li class="m-menu__item " aria-haspopup="true" >
		<a  href="{{ url('/dashbord/categories') }}" class="m-menu__link ">
			<i class="m-menu__link-icon fa fa-list"></i>
			<span class="m-menu__link-title">
				<span class="m-menu__link-wrap">
					<span class="m-menu__link-text">

					Categories										</span>
				</span>
			</span>
		</a>
	</li>

	<li class="m-menu__item " aria-haspopup="true" >
		<a  href="{{ url('/dashbord/messages') }}" class="m-menu__link ">
			<i class="m-menu__link-icon flaticon-line-graph"></i>
			<span class="m-menu__link-title">
				<span class="m-menu__link-wrap">
					<span class="m-menu__link-text">
						messages
					</span>
					@if(\App\Contact::where('seen',false)->count() != 0)
					<span class="m-menu__link-badge">
						<span class="m-badge m-badge--danger">
							{{\App\Contact::where('seen',false)->count()}}
						</span>
					</span>
					@endif
				</span>
			</span>
		</a>
	</li>


</ul>
</div>