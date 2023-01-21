Material Icons（Google Font Icons）の使い方を解説！  
https://webdesign-trends.net/entry/14598

Tailwindcss入門】利用者急上昇中のCSSフレームワークのTailwindcssで簡単なウェブサイトを作ってみよう  
https://www.youtube.com/watch?v=4wTVdlL_YGU




本番環境にデプロイしたらTailwind CSSが効かない時に確認すること
https://de-milestones.com/tailwindcss-not-work-after-deploy/

TailwindCSSが適用されないときに確認したこと
https://mai.kosodante.com/usetailwindcsswithjavascript/



TailwindCSSのパーツ集S  
https://www.tailwind-kit.com/components/sidebar#


【永久保存版】Tailwind CSS　チートシート 3.x対応  
https://uedive.net/2021/5596/tailwind-css/







詰んだ事例集


--------
【詰んだこと】  

【解決策】  


【結論】  

【参考にしたサイト等】  


--------





--------
【詰んだこと】　　
TailwindCSSが効かない、フォントサイズや色が変わっていない  
設定は下記動画通り実行した  
https://www.youtube.com/watch?v=4wTVdlL_YGU

【解決策】
二つある

1点目　　
tailwind.config.jsでsrcフォルダ以下のファイルにTailwindCSSを適用する設定がされているようだ。　　
→多分ここ[  content: ["./src/**/*.{html,js}"], ]　　
そのため、ファイルをsrcフォルダに移動した。


2点目  
headerタグ内で以下の通りでoutput.cssを読み込んでいる。  
<link href="/dist/output.css" rel="stylesheet">  
これはtailwindCSSや上記で記載のYoutube動画と同じ記述であるが、  
パスの指定が不適と考え下記のように修正。  
<link href="../dist/output.css" rel="stylesheet">


【結論】  
解決(2023/01/22)  

【参考にしたサイト等】　　
https://de-milestones.com/tailwindcss-not-work-after-deploy/  
https://mai.kosodante.com/usetailwindcsswithjavascript/  
--------


--------
【詰んだこと】  
チェックボックスのクリック後の色を青から別の色に変えたい  
【解決策】  


【結論】  
未解決  

【参考にしたサイト等】  


--------