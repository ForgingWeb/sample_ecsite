//ページの高さからhedderとfutterの高さを引き　sectionの高さを設定する
$(window).on('load resize',function(){

        var ua = navigator.userAgent;
        if (ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0) {
            // スマートフォン用コード
        } else if (ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0) {
            // タブレット用コード
        } else {
            // PC用コード
            var wH = $(window).height();// 表示画面の高さを取得
            var hedH = $('header').innerHeight();
            var fooH = $('footer').innerHeight();
            var secH = wH - hedH - fooH;// 表示画面とナビエリアの差分を算出
            $('section').css('height', secH + 'px');// 算出した差分をヘッダーエリアの高さに指定
        }
     
  });