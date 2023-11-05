@extends('layouts.master')


@section('content')

 <!--section-heading-->
 <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         @if (isset($search))
                            <h1>{{$search}}</h1>
                            @else
                            <h1>All Blogs</h1>
                         @endif
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                 <!--post 1-->
             @forelse ($blogs as $blog)
                    <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="{{ route('root.single', $blog->id)}}">
                                <img src="{{ asset('uploads/blog')}}/{{$blog->image}}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <h3 class="entry-title">
                                <a href="{{ route('root.single', $blog->id)}}">{{ $blog->title}}</a>
                            </h3>
                            <ul class="entry-meta">
                                <li class="post-author-img"><img src="{{ asset('uploads/default')}}/{{$blog->RelationWithUser->image}}" alt=""></li>
                                <li class="post-author"> <a href="author.html">{{$blog->RelationWithUser->name}}</a></li>
                                <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> {{$blog->RelationWithCategory->title}}</a></li>
                                <li class="post-date"> <span class="line"></span> {{ \Carbon\Carbon::parse($blog->date)->format('M , d- Y') }}</li>
                            </ul>
                            <div class="post-exerpt">
                                <p>

                                    <?php
                                    $blog_des = strip_tags($blog->description);
                                    $blog_id = $blog->id;
                                    if(strlen($blog_des > 250)):
                                    $blog_cut = substr($blog_des,0,250);
                                    $endpoint= strrpos($blog_cut, " ");
                                    $blog_des = $endpoint?substr($blog_cut,0,$endpoint):substr($blog_cut,0);
                                    $blog_des .= ".....";
                                  endif;
                                  echo $blog_des;


                                    ?>
                                    <a href="{{ route('root.single', $blog->id)}}" class='text-info fw-bold'>Read More</a>
                            </div>
                            <div class="post-btn">
                                <a href="{{ route('root.single', $blog->id)}}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
             @empty
             <div class="post-list post-list-style2" >
                <div class="post-list-image" >
                    <a href="javascript::void()" >
                        <img style="margin-left:300px; height:200px;" src="{{ Avatar::create('Not Found')->toBase64() }}" alt="">
                    </a>
                </div>
                <div class="post-list-content" style="margin-right: 300px;">
                    <h3 class="entry-title">
                        <a href="javascript::void()">NO Title Found</a>
                    </h3>
                    <ul class="entry-meta">
                        <li class="post-author-img"><img  src="{{ Avatar::create('Not Found')->toBase64() }}" alt=""></li>
                        <li class="post-author"> <a href="author.html"></a></li>
                        <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span>empty</a></li>
                        <li class="post-date"> <span class="line"></span>empty</li>
                    </ul>
                    <div class="post-exerpt">
                        <p>

                       No Data Found
                        </p>
                    </div>
                    <div class="post-btn">
                        <a href="javascript::void()"  class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
             @endforelse


             </div>
         </div>
     </div>
 </section>


<!--pagination-->
<div class="pagination">
     <div class="container-fluid">
         <div class="pagination-area">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="pagination-list">
                        <ul class="list-inline">
                            @if ($blogs->onFirstPage())
                                <li class="disabled"><a href="#"><i class="las la-arrow-left"></i></a></li>
                            @else
                                <li><a href="{{ $blogs->previousPageUrl() }}"><i class="las la-arrow-left"></i></a></li>
                            @endif

                            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                @if ($page == $blogs->currentPage())
                                    <li><a href="{{ $url }}" class="active">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            @if ($blogs->hasMorePages())
                                <li><a href="{{ $blogs->nextPageUrl() }}"><i class="las la-arrow-right"></i></a></li>
                            @else
                                <li class="disabled"><a href="#"><i class="las la-arrow-right"></i></a></li>
                            @endif
                        </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>




@endsection
