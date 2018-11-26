/*
//---------------------------------------------------------------------------
// Other Function
//---------------------------------------------------------------------------
*/
/* 替所有 Ajax 請求加上 CSRF 防禦 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/*
//---------------------------------------------------------------------------
// Document Ready Function
//---------------------------------------------------------------------------
*/
$(function () {
    // goToTop 回置頁面頂端
    $("#goTop").click(function () {
        $("html,body").animate({
            scrollTop: 0
        }, 1000);
    });

    // 頁面自動捲動時, 緩慢執行
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#gotop').fadeIn("fast");
        } else {
            $('#gotop').stop().fadeOut("fast");
        }
    });

    // 隱藏 required 顯示的警告訊息
    $('input, select, textarea').on("invalid", function (e) {
        e.preventDefault();
    });

    // 點擊 nav-search 以外的地方則關閉 nav-search 和 navbar-collapse
    $(".main-container").click(function () {
        // 關閉 nav-search
        $('#nav-search').fadeOut(300);
        // 順便清除 searchbar 的內容
        $('#navSearchBar').val('');
        // 關閉 navbar-collapse
        var _opened = $(".navbar-collapse").hasClass("navbar-collapse") && $(".navbar-collapse").hasClass("in");
        if (_opened === true && !($(event.target).hasClass("navbar-toggle"))) {
            $("button.navbar-toggle").click();
        }
    });
    // 點擊的若是 nav-search 則中斷「關閉動作」
    // $(".navbar-right").click(function (event) {
    //     event.stopPropagation();
    // });
    // $("#nav-search").click(function (event) {
    //     event.stopPropagation();
    // });
});

/*
//---------------------------------------------------------------------------
// Layout
//---------------------------------------------------------------------------
*/
// 顯示導覽搜尋列 nav-search
function showNavSearch() {
    $('#nav-search').fadeIn(300);
    document.getElementById("navSearchBar").focus();
};

// 關閉導覽搜尋列 nav-search
function closeNavSearch() {
    $('#nav-search').fadeOut(300);
    // 順便清除 searchbar 的內容
    $('#navSearchBar').val('');
};

/*
//---------------------------------------------------------------------------
// SearchBar
//---------------------------------------------------------------------------
*/
/* 更換搜尋模式(searchType) */
function changSearchType(searchType) {
    if (searchType == "pest") {
        searchTypeText = $("#searchPest").html();
    } else if (searchType == "plant") {
        searchTypeText = $("#searchPlant").html();
    } else {
        searchTypeText = $("#searchArea").html();
    }
    $("#searchType").val(searchTypeText);
};

/*
//---------------------------------------------------------------------------
// Catalog
//---------------------------------------------------------------------------
*/
/* 展開目錄細項 (害蟲&植株適用) */
function openCatalog(categoryNum) {
    // console.log(categoryNum);
    /* 先判斷是害蟲或植株目錄，將目標網址存入變數 catagoryUrl */
    if (categoryNum.substr(0, 1) == 'A') {
        var catagoryUrl = LaravelUrl + 'GetPestCategoryData';
        var detailUrl = 'pestDetailed/';
    } else {
        var catagoryUrl = LaravelUrl + 'GetPlantCategoryData';
        var detailUrl = 'plantDetailed/';
    }
    // console.log(catagoryUrl);
    $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        /* GET -> 前端處理資料版本 */
        // type: 'GET',
        /* POST -> 後端處理資料版本 */
        type: "POST",
        url: catagoryUrl,
        data: {
            categoryNum: categoryNum
        },
        success: function (data) {
            // console.log(data);
            var dataset = '';
            for (i = 0; data.length > i; i++) {
                if (data[i].categoryNum == categoryNum) {
                    str = '<div class="img-box col-xs-12 col-sm-6 col-md-4">' +
                        '<a href="' + LaravelUrl + detailUrl + data[i].name + '">' +
                        '<div class="img-innerbox">' +
                        '<div class="img">' +
                        "<img class='main' src='" + LaravelUrl + "img/image.jpg' alt=''>" +
                        // "<img class='main' src='127.0.0.1/pesthelper/public/img/image.jpg' alt=''>" +
                        '</div>' +
                        '<hr />' +
                        '<div class="base">' +
                        "<p class='text-article-1'>" + data[i].name + "</p>" +
                        "<p class='text-small-1'>" + data[i].scientificName + "</p>" +
                        "</div></div></a></div>";
                    dataset += str;
                }
            }
            $('#collapse-' + categoryNum).children('.panel-body').children('.row').html(dataset);
        }
    })
};
