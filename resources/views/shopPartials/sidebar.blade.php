<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        @foreach($categories as $categoryFeild)
        <span class="spanCategory">
            <h5>{{ $categoryFeild->name }}</h3>
        </span>
        <div class="panel-group category-products" id="accordian_{{ $categoryFeild->id }}"><!--category-productsr-->
            @foreach($categoryFeild->categoriesChildrent as $category)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian_{{ $categoryFeild->id }}" href="#sportswear_{{ $category->id}}">
                            <span class="badge pull-right">
                                @if(!$category->categoriesChildrent->isEmpty())
                                <i class="fa fa-plus"></i>
                                @endif
                            </span>
                            {{ $category->name }}
                        </a>
                    </h4>
                </div>
                <div id="sportswear_{{ $category->id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        @foreach($category->categoriesChildrent as $categoryChildrent)
                        <ul>
                            <li><a href="{{ route('productList', ['category_id' => $categoryChildrent->id]) }}">{{ $categoryChildrent->name }} </a></li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div><!--/category-products-->
        @endforeach

        
    </div>
</div>