### 目標
https://gsacademy.jp/column/tky-019/<br>



### CSS
本番環境にデプロイしたらTailwind CSSが効かない時に確認すること<br>
https://de-milestones.com/tailwindcss-not-work-after-deploy/<br>

### TailwindCSS
TailwindCSSが適用されないときに確認したこと<br>
https://mai.kosodante.com/usetailwindcsswithjavascript/<br>


TailwindCSSのパーツ集S  <br>
https://www.tailwind-kit.com/components/sidebar#<br>

【永久保存版】Tailwind CSS　チートシート 3.x対応  <br>
https://uedive.net/2021/5596/tailwind-css/<br>
Tailwindcss入門】利用者急上昇中のCSSフレームワークのTailwindcssで簡単なウェブサイトを作ってみよう  <br>
https://www.youtube.com/watch?v=4wTVdlL_YGU<br>

### データベース <br>
データベースオブジェクトの命名規約<br>
https://qiita.com/genzouw/items/35022fa96c120e67c637<br>
中間テーブルとは<br>
https://qiita.com/morikuma709/items/9fde633db9171b36a068<br>
やさしい図解で学ぶ　中間テーブル　多対多　概念編<br>
https://qiita.com/ramuneru/items/db43589551dd0c00fef9<br>
ER図とは？書き方やテクニックをわかりやすく解説<br>
https://products.sint.co.jp/ober/blog/create-er-diagram<br>
ER図（実体関連図）とは？<br>
https://www.lucidchart.com/pages/ja/er-diagram<br>

### デザイン <br>
日本の色<br>
https://nipponcolors.com/#sensaicha<br>
なぜエンジニアが作る画面はダサいのか…?<br>
https://qiita.com/mskmiki/items/544149987475719e417b<br>
【まとめ】エンジニア向けデザイン参考サイト<br>
https://qiita.com/KNR109/items/78b3ca7cae7615dac0b0<br>
プロダクトを死へと誘う複雑性の恐ろしさと、それを最適化する10個の方法<br>
https://note.com/kajiken0630/n/nec15a5dd69d2<br>
Material Icons（Google Font Icons）の使い方を解説！ <br> 
https://webdesign-trends.net/entry/14598<br>





詰んだ事例集<br>


--------<br>
【詰んだこと】<br>  

【解決策】<br>


【結論】<br>

【参考にしたサイト等】<br>

--------<br>





--------
【詰んだこと】<br>
TailwindCSSが効かない、フォントサイズや色が変わっていない<br>  
設定は下記動画通り実行した<br>  
https://www.youtube.com/watch?v=4wTVdlL_YGU<br>

【解決策】<br>
二つある<br>

1点目<br>
tailwind.config.jsでsrcフォルダ以下のファイルにTailwindCSSを適用する設定がされているようだ。<br>　　
→多分ここ[  content: ["./src/**/*.{html,js}"], ]. <br>
そのため、ファイルをsrcフォルダに移動した。<br>


2点目<br>
headerタグ内で以下の通りでoutput.cssを読み込んでいる。<br>
<link href="/dist/output.css" rel="stylesheet"><br>
これはtailwindCSSや上記で記載のYoutube動画と同じ記述であるが、<br>
パスの指定が不適と考え下記のように修正。<br>
<link href="../dist/output.css" rel="stylesheet"><br>


【結論】<br>
解決(2023/01/22)<br>

【参考にしたサイト等】<br>　  
https://de-milestones.com/tailwindcss-not-work-after-deploy/<br>
https://mai.kosodante.com/usetailwindcsswithjavascript/<br>
--------


--------
【詰んだこと】<br>
チェックボックスのクリック後の色を青から別の色に変えたい<br>
【解決策】<br>


【結論】<br>
未解決<br>

【参考にしたサイト等】<br>


--------

後で見る<br>
かけだしSEのためのデータベース設計入門<br>
https://proengineer.internous.co.jp/content/columnfeature/6499 <br>

【入門】データベース設計まとめ<br>
https://qiita.com/KNR109/items/5d4a1954f3e8fd8eaae7 <br>





sangetu<br>
https://www.sangetsu.co.jp/ <br>