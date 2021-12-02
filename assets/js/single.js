// 定数
const single_text_id = "single-text";
// 変数
let single_text = "";        // 投稿のテキスト
let single_imgs = {};   // 投稿の画像の文字列(連想配列)
let single_text_elem;   // 投稿のテキストの要素
let single_img_elem;    // 投稿の画像の要素
let single_text_boxes_top = {};  // 投稿の各テキストのトップ
let single_text_boxes_bottom = {};

// 関数

// 投稿を整理する
function organizeContents(contents) {
    // 重複削除
    let new_contents = Array.from(new Set(contents));
    // \n\nを削除
    var index = new_contents.indexOf("\n\n");
    new_contents.splice(index, 1);
    return new_contents;
}

// 投稿の文字列内にimgタグが存在するか
function existImgTag(str) {
    // console.log("existimgtag");
    let res = str.search("wp:image");
    if ( res > 0 ) return true;
    else return false;
}

// テキストとimgを分割
function divideTextImg(contents) {
    const parser = new DOMParser();
    let id_num = 0;
    for (let iter=0; iter < contents.length; iter++) {
        // divタグ生成
        single_text += '<div id="'+single_text_id+id_num+'" class="text-box">';
        while( !existImgTag(contents[iter]) ) { // imgタグがない場合
            single_text += contents[iter];
            iter++; // テキストを追加したから配列のイテレータを次に
            if( iter == contents.length - 1 ) {
                single_text += '</div>\n';
                console.log(single_imgs);  
                return;
            }
        }
        single_text += '</div>\n';
        const html_doc = parser.parseFromString(contents[iter], "text/html");
        const img = html_doc.querySelector("img");
        single_imgs[single_text_id+id_num] = img.src;
        id_num++;
    }
    console.log(single_imgs);
    return;
}
/* --------------- テキスト ----------------*/

// 投稿のテキストをHTML表示
function displayText(text) {
    // console.log("displaytext");
    const text_elem = document.getElementById(single_text_id);
    text_elem.insertAdjacentHTML('beforeend', text);
    return;
}

// 投稿のテキストの要素首都樹
function setElementSingleText() {
    // console.log("getelementsingle");
    single_text_elem = document.getElementById(single_text_id);
}

// 各テキストトップからの距離を取得(配列)
function setTextBoxesRect() {
    let text_boxes_elem = single_text_elem.getElementsByClassName("text-box");
    for (let i = 0; i < text_boxes_elem.length; i++) {
        let text_boxes_rect = text_boxes_elem.item(i).getBoundingClientRect();
        single_text_boxes_top[single_text_id+i] = pageYOffset + text_boxes_rect.top;
        single_text_boxes_bottom[single_text_id+i] = pageYOffset + text_boxes_rect.bottom;
    }
    single_text_boxes_top[single_text_id+"0"] = 0;
    // return [tops, bottoms];
    console.log(single_text_boxes_top, single_text_boxes_bottom);
    return;
}
/* --------------- 画像 ----------------*/
// 画像の要素取得(更新)
function setElementImg() {
    single_img_elem = document.getElementById("single-img");
}

// 表示内に表示されるテキストに合わせて画像を変える
function changeImg(){
    // スクロールされたときのトップからの距離
    let scroll_top = $(window).scrollTop();
    // for文でimgの配列文探索する。switchでは、ダメ
    // topとbottom間で画像の切り替えを行う
    for (let i = 0; i < Object.keys(single_imgs).length; i++) {
        console.log(scroll_top, single_text_boxes_top[single_text_id+i], single_text_boxes_bottom[single_text_id+i]);
        if (single_text_boxes_top[single_text_id+i] <= scroll_top && scroll_top < single_text_boxes_bottom[single_text_id+i]) {
            single_img_elem.src = single_imgs[single_text_id+i];
            break;
        } 
    }   
}

/* --------------- 実行  ----------------*/
// load時の処理
window.addEventListener("load", function(){
    // contentsからテキストと画像を分割
    divideTextImg(organizeContents(contents));
    // テキスト
    // テキスト表示
    // console.log(single_text);
    displayText(single_text);
    // テキストの要素を取得(表示されたから)
    setElementSingleText();
    // 各テキストの要素
    setTextBoxesRect();
    // 画像
    setElementImg();
    // onLoadSingleImg(single_imgs[single_text_id+"0"]);
    changeImg();
});

// scroll時の処理
$(window).scroll(function(){
    changeImg();
});
