<style>
    body{
            text-align:center;
            margin:0;
        }
    nav a{
        text-decoration: none;
        color:inherit;
    }
    nav > ul {
    list-style: none;   /* 移除項目符號 */
}
nav{
    position: fixed;
    width: 100%;
    margin: 0;
}
nav > ul {
    background-color: rgb(230, 230, 230);
    list-style: none;   /* 移除項目符號 */
    margin: 0;
    padding: 0;
}
nav a {
    color: inherit; /* 移除超連結顏色 */
    font-size: 1.2rem;
    display: block; 
    padding: 10px;
    text-decoration: none;  /* 移除超連結底線 */
}
nav a:hover {
    background-color: rgb(115, 115, 115);
    color: white;
}
.flex-nav {
    display: flex;
    justify-content:space-evenly;
}
li{
    width: auto;
}
/* search bar */
.img{
    
    top: 0%;
    
}
.box:focus{
    width: 100%;
    
}
.input{
    background-color: rgb(230, 230, 230);
    border-style:none ;
    width: 20%;
    height: 100%;
    transition: .5s;
    z-index: -1;
}
.input:focus{
    width: 100%;
    height: 100%;
    background-color: white;
}
#logWindow{
    
    width: 100%;
    height:0%;
    transition: .5s;
}
#login:hover > #logWindow{
    
    
    width: 100%;
    height:50%;
    background-color: black;
}

</style>
<nav >
    <ul class="flex-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="select.php">BookList</a></li>
        <?php 
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            echo'<li><a id="logout"href="logout.php" >LogOut</a></li>';
        }
        ?>
        
        <li>
            <div class="box"> 
            <form action="search.php" method="post">
            <input type="text" class="input" name="search" placeholder="搜尋">
        </form>
            </div></li>
        
    </ul>

</div>
</nav>
<div id="logWindow">
