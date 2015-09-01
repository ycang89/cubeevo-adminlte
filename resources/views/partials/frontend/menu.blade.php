<div id="cd-nav">
	<a href="#0" class="cd-nav-trigger">Menu<span></span></a>

    @if(isset($backbtn))
    <a href="{{$backbtn}}" class="smart-object" style="position: fixed;
    top: 20px;
    left: 7%;
    width: 44px;
    height: 44px;
    background: white;
    border-radius: 0.25em; 
    text-indent: 100%;
    white-space: nowrap;
    z-index: 10;"> 
        <div class="arrow-left arrow">
            <div class="arrow-bar-1 smart-transition"></div>
            <div class="arrow-bar-2 smart-transition"></div>
        </div>
    </a>
    @endif

	<div id="cd-main-nav">
        <div class="inner">
        
        	<div class="logo">
            	<img src="{{ asset('img/Images-07.png') }}" width="110%" class="logo-nav" style="margin-left: -5%;">
                <img src="{{ asset('img/Images-07-mob.png')}}" class="logo-mob">
            </div>               
            
    		<ul class="list-unstyled">
    			<li><a href="{{ url('/') }}">{{ (Session::get('locale') == 'en') ? 'CUBEEVO\'S DNA' : '形立方性格' }}</a></li>
    			<li><a href="{{ url('/about-us') }}">{{ (Session::get('locale') == 'en') ? 'ABOUT US' : '关于我们' }}</a></li>
    			<li><a href="{{ url('/credential') }}">{{ (Session::get('locale') == 'en') ? 'CREDENTIALS' : '案例与反馈' }}</a></li>
    			<li><a href="{{ url('/solution') }}">{{ (Session::get('locale') == 'en') ? 'SOLUTIONS' : '专业服务' }}</a></li>
    			<li><a href="{{ url('/research') }}" class="hide">{{ (Session::get('locale') == 'en') ? 'RESEARCH' : '品牌洞察' }}</a></li>
                <li><a href="{{ url('/process') }}">{{ (Session::get('locale') == 'en') ? 'LET\'S WORK TOGETHER' : '合作流程' }}</a></li>
                <li><a href="{{ url('/contact-us') }}">{{ (Session::get('locale') == 'en') ? 'CONTACT US' : '联络我们' }}</a></li>
                <li><a href="{{ url('locale/en') }}">EN</a> | <a href="{{ url('locale/cn') }}">中文</a></li>
    		</ul> 
            
            <div>   
                <div class="cd-social">
                    <ul class="list-inline">
                        <?php use App\Models\Setting; ?>
                        @if(!empty(Setting::where('code', '=', 'facebook_link')->first()->value))
                        <li>
                            <a href="{{Setting::where('code', '=', 'facebook_link')->first()->value}}" class="cd-scfb" target="_blank">FB</a>
                        </li>
                        @endif
                        @if(!empty(Setting::where('code', '=', 'youtube_link')->first()->value))
                        <li>
                            <a href="{{Setting::where('code', '=', 'youtube_link')->first()->value}}" class="cd-scyt" target="_blank">Youtube</a>
                        </li>
                        @endif
                        @if(!empty(Setting::where('code', '=', 'instagram_link')->first()->value))
                        <li>
                            <a href="{{Setting::where('code', '=', 'instagram_link')->first()->value}}" class="cd-scin" target="_blank">Instagram</a>
                        </li>
                        @endif
                    </ul>
                </div>
                
                <div class="smalltext">
                &copy; 2015 COPYRIGHT BY <br>
                CUBEEVO ADVERTISING SDN. BHD.
                </div>
            </div> 
    	</div>
    </div>
</div> 