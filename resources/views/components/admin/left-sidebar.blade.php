<div class="main-sidebar">
    <div class="main-menu">
        <ul class="sidebar-menu scrollable">

            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.main_page')</a>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.sliders.index', 'admin.useful-link.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('sliders-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.sliders.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.slider')</span>
                            </a>
                        </li>
                    @endcan
                    @can('useful-link-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.useful-link.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.useful_links')</span>
                            </a>
                        </li>
                    @endcan
                    @can('useful-link-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.commits.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.commits')</span>
                            </a>
                        </li>
                    @endcan
                    @can('useful-link-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.faqs.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.faqs')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            @can('services-view')
                <li class="sidebar-item">
                    <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.services')</a>
                    <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.service.index','admin.trainings.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.service.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.services')</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.category_news')</a>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.category.index', 'admin.news.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('category-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.category.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.categories')</span>
                            </a>
                        </li>
                    @endcan
                    @can('news-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.news.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.news')</span>
                            </a>
                        </li>
                    @endcan
                    @can('news-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.projects.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.projects')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.word_translations')</a>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.translations.index', 'admin.site-words.index', 'admin.admin-words.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('translations-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.translations.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.translations')</span>
                            </a>
                        </li>
                    @endcan
                    @can('translations-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.site-words.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.site_words')</span>
                            </a>
                        </li>
                    @endcan
                    @can('translations-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.admin-words.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.admin_words')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.contact')</a>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.complaint.index','admin.settings.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('settings-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.settings.index') }}" class="sidebar-link  {{ Route::currentRouteName() === 'admin.settings.index' ? 'active' : '' }}">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.settings')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.security')</a>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.cms-users.index', 'admin.cms-users.logs', 'admin.roles.index', 'admin.permissions.index', 'admin.settings.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('cms_users-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.cms-users.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.cms_users')</span>
                        </a>
                    </li>
                    @endcan
                    @can('logs-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.cms-users.logs') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.logs')</span>
                        </a>
                    </li>
                    @endcan
                    @can('roles-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.roles.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.roles')</span>
                        </a>
                    </li>
                    @endcan
                    @can('permissions-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.permissions.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.permissions')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </div>
</div>
