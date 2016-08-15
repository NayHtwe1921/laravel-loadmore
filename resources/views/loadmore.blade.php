@extends('layouts.app')

@section('js')
<script>

// 初始化
var page = 1; // 第一頁
load_more(page); // 初始化第一頁

// 偵測頁面滾動
$(window).scroll(function() {
    // $(window).scrollTop() : 離頂多遠
    // $(window).height() : 可視長度
    // $(document).height() : 網頁內容長度
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        page++; // 到下一頁
        load_more(page); // 載入下一頁
    }
});

// ajax
function load_more(page){
    $.ajax(
    {
        url: '?page=' + page,
        type: "get",
        datatype: "html",
        beforeSend: function() // 再送出之前 出現載入圖片
        {
            $('.ajax-loading').show();
        }
    })
    .done(function(data)
    {
        // 如果資料為空
        if(data.length == 0){
            $('.ajax-loading').html("No more records!");
            return;
        }

        // 如果資料不為空
        $('.ajax-loading').hide(); //hide loading animation once data is received
        $("#results").append(data); //append data into #results element
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
        alert('No response from server');
    });
}
</script>
@endsection

@section('content')
<style>
.wrapper > ul#results li {
  margin-bottom: 1px;
  background: #f9f9f9;
  padding: 20px;
  list-style: none;
}
.ajax-loading{
  text-align: center;
}
</style>
<div class="wrapper">
    <ul id="results">{{-- 載入的內容 --}}</ul>
    <div class="ajax-loading"><img src="http://demo.expertphp.in/images/loading.gif" /></div>
</div>
@endsection
