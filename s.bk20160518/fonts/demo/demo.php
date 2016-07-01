
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>IconFont</title>
    <link rel="stylesheet" href="demo.css">
    <link rel="stylesheet" href="iconfont.css">
<style>

</style>
</head>
<body>
    <div class="main">
        <h1>IconFont 图标</h1>
        <ul class="icon_lists clear">
            
                <li>
                <i class="icon ds-iconfont ds-icon-jian"></i>
                    <div class="name">减</div>
                    <div class="code">&amp;#x1610;</div>
                    <div class="fontclass">.jian</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont ds-icon-blacklist"></i>
                    <div class="name">heiman</div>
                    <div class="code">&amp;#xe609;</div>
                    <div class="fontclass">.blacklist</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe600;</i>
                    <div class="name">ds-icons-pei</div>
                    <div class="code">&amp;#xe600;</div>
                    <div class="fontclass">.pei</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe601;</i>
                    <div class="name">ds-icons-pi</div>
                    <div class="code">&amp;#xe601;</div>
                    <div class="fontclass">.pi</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe602;</i>
                    <div class="name">ds-icons-que</div>
                    <div class="code">&amp;#xe602;</div>
                    <div class="fontclass">.que</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe603;</i>
                    <div class="name">ds-icons-sale</div>
                    <div class="code">&amp;#xe603;</div>
                    <div class="fontclass">.service</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe604;</i>
                    <div class="name">ds-icons-shougong</div>
                    <div class="code">&amp;#xe604;</div>
                    <div class="fontclass">.shou</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe605;</i>
                    <div class="name">ds-icons-tao</div>
                    <div class="code">&amp;#xe605;</div>
                    <div class="fontclass">.tao</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe606;</i>
                    <div class="name">ds-icons-tong</div>
                    <div class="code">&amp;#xe606;</div>
                    <div class="fontclass">.tong</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe607;</i>
                    <div class="name">ds-icons-tui</div>
                    <div class="code">&amp;#xe607;</div>
                    <div class="fontclass">.tui</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe608;</i>
                    <div class="name">ds-icons-zeng</div>
                    <div class="code">&amp;#xe608;</div>
                    <div class="fontclass">.zeng</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe60a;</i>
                    <div class="name">ds-icons-he</div>
                    <div class="code">&amp;#xe60a;</div>
                    <div class="fontclass">.he</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe60b;</i>
                    <div class="name">ds-icons-jin</div>
                    <div class="code">&amp;#xe60b;</div>
                    <div class="fontclass">.jing</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe60c;</i>
                    <div class="name">ds-icons-chai</div>
                    <div class="code">&amp;#xe60c;</div>
                    <div class="fontclass">.chai</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe60d;</i>
                    <div class="name">ds-icons-dai</div>
                    <div class="code">&amp;#xe60d;</div>
                    <div class="fontclass">.dai</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe60e;</i>
                    <div class="name">ds-icons-dai2</div>
                    <div class="code">&amp;#xe60e;</div>
                    <div class="fontclass">.daifu</div>
                </li>
            
                <li>
                <i class="icon ds-iconfont">&#xe60f;</i>
                    <div class="name">ds-icons-link</div>
                    <div class="code">&amp;#xe60f;</div>
                    <div class="fontclass">.link</div>
                </li>
            
        </ul>


        <div class="helps">
            第一步：使用font-face声明字体
            <pre>
@font-face {font-family: 'ds-iconfont';
    src: url('iconfont.eot'); /* IE9*/
    src: url('iconfont.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
    url('iconfont.woff') format('woff'), /* chrome、firefox */
    url('iconfont.ttf') format('truetype'), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/
    url('iconfont.svg#ds-iconfont') format('svg'); /* iOS 4.1- */
}
</pre>
第二步：定义使用iconfont的样式
            <pre>
.ds-iconfont{
    font-family:"ds-iconfont" !important;
    font-size:16px;font-style:normal;
    -webkit-font-smoothing: antialiased;
    -webkit-text-stroke-width: 0.2px;
    -moz-osx-font-smoothing: grayscale;}
</pre>
第三步：挑选相应图标并获取字体编码，应用于页面
<pre>
&lt;i class="ds-iconfont"&gt;&amp;#x33;&lt;/i&gt;
</pre>
        </div>

    </div>
</body>
</html>
