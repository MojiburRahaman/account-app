<style>
    .pro-pagination-style a:hover {
        color: #fff;
        background-color: #ef4836;
        box-shadow: 0 5px 15px 0 rgba(153, 63, 107, .5);
        transform: translateY(-1px);
        border-color: #fb5d5d;
    }

    .page-link:hover {
        z-index: 2;
        color: #0a58ca;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .pro-pagination-style a {
        font-weight: 400;
        color: #1d1d1d;
        padding: 0;
        height: 40px;
        line-height: 40px;
        background: #f6f6f6;
        font-size: 14px;
        display: inline-block;
        width: 40px;
        border-radius: 100%;
        text-align: center;
        vertical-align: top;
        font-size: 16px;
        transition: all .3s ease 0s;
    }

    .pro-pagination-style li+li {
        margin-left: 10px;
    }

    .text-center {
        text-align: center !important;
    }

    dl,
    ol,
    ul {
        margin-top: 0;
        margin-bottom: 0;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .pro-pagination-style li {
        display: inline-block;
    }

    li {
        list-style: none;
    }

   

</style>
<div class="pro-pagination-style text-center" data-aos="fade-up" data-aos-delay="200">
    <div class="pages">
        <ul>
            @if ($paginator->hasPages())

            @if ($paginator->onFirstPage())

            <li class="li"><a class="page-link"><i class="fa fa-angle-left"></i></a></li>
            @else
            <li class="li"><a class="page-link" href="{{$paginator->previousPageUrl()}}"><i
                        class="fa fa-angle-left"></i></a></li>

            @endif

            @foreach ($elements as $element)

            @if (is_string($element))
            <li class="disabled"><span>{{ $element }}</span></li>
            @endif



            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="li"><a style="background: #ef4836;color:white;box-shadow: 0 5px 15px 0 rgba(153, 63, 107, .5);"
                    class="page-link active">{{ $page }}</a></li>
            @else
            <li class="li"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @endforeach
            @endif
            @endforeach


            &nbsp;
            <span>
                @if ($paginator->hasMorePages())
                <li class="li"><a class="page-link" href="{{$paginator->nextPageUrl()}}"><i
                            class="fa fa-angle-right"></i></a>
                    @else
                <li class="li"><a class="page-link"><i class="fa fa-angle-right"></i></a>
            </span>
            @endif

            @endif
        </ul>
    </div>
</div>