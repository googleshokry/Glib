<li class="nav-item dropdown ">
    <a class="dropdown-toggle" href="javascript:void(0);">
        <span class="icon-holder">
            <i class=" {{@$iconColor?? "c-orange-500"}} {{@$icon ?? "ti-layout-list-thumb"}} "></i>
        </span>
        <span class="title">
            {{$title}}
        </span>
        <span class="arrow">
            <i class="ti-angle-right"></i>
        </span>
    </a>
    <ul class="dropdown-menu">
        @foreach($items as $item)
            <li><a class="sidebar-link" href="{{$item["link"]}}">{{$item["title"]}}</a></li>
        @endforeach
    </ul>
</li>