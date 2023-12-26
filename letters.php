<?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    class Person {
        public $name;
        public $message;
        public $pass;
        function __construct($name, $pass) {
            $this->name = $name;
            $this->pass = $pass;
        }
        function get_name() { return $this->name; }
        function get_pass() { return $this->pass; }
    }

    $people = [
        "fur" => new Person("Fur", "formigaatomica"),
        "julia" => new Person("Julia", "abacaxi"),
        "merhy" => new Person("Merhy Endy", "cassio"),
        "rita" => new Person("Rita", "seupereira"),
        "lena" => new Person("Lena", "leiterosa"),
        "pedro" => new Person("Pedro", "saboneteliquido"),
        "mae" => new Person("Edna", ""),
        "denis" => new Person("Denis", "meiosangue"),
        "diogo" => new Person("Diogo", "minecraft"),
        "ary" => new Person("Ary", "carioca"),
        "alana" => new Person("Alana", "loirinha"),
        "miau" => new Person("Miau", "doctorwho"),
        "malu" => new Person("Malu", "paulista"),
    ];

    if (!isset($_GET["q"])) { header("Location: /"); }
    if (!isset($people[$_GET["q"]])) { header("Location: /"); }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
        <title>Merhy Christmas</title>
        
        <!-- META TAGS -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <!-- SEO -->
        <meta name="author" content="Speck">
        <meta name="description" content="Site Natalino para amigues de Speck">
        <meta name="keywords" content="christmas, merhy, speck">
        <link rel="canonical" href="https://merhy.christmas/">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

        <!-- Stylesheets -->
        <link rel="preload" as="style" onload="this.remove();" href="assets/css/main.css?t=<?php echo date('YmdHis'); ?>" type="text/css">
        <link rel="stylesheet" href="assets/css/main.css?t=<?php echo date('YmdHis'); ?>" type="text/css">
        <link rel="preload" as="style" onload="this.remove();" href="assets/css/nth.css?t=<?php echo date('YmdHis'); ?>" type="text/css">
        <link rel="stylesheet" href="assets/css/nth.css?t=<?php echo date('YmdHis'); ?>" type="text/css">
        <link rel="preload" as="style" onload="this.remove();" href="assets/css/letters.css?t=<?php echo date('YmdHis'); ?>" type="text/css">
        <link rel="stylesheet" href="assets/css/letters.css?t=<?php echo date('YmdHis'); ?>" type="text/css">
</head>
<body>
    <header>
        <?php 
        
            if (isset($_GET["p"])) {
                if ($_GET["p"] === "o") { echo "<p>Dedico essa página a meu amigo</p>"; }
                else if ($_GET["p"] === "a") { echo "<p>Dedico essa página a minha amiga</p>"; }
                else { echo "<p>Dedico essa página a mi amigue</p>"; }
            } else { echo "<p>Dedico essa página a mi amigue</p>"; }
        
        ?>
        <h1><?php echo $people[$_GET["q"]]->get_name() ; ?></h1>
    </header>
    <main>
        <p>Eu tenho uma mensagem muito especial para 
        <?php 
            
            if (isset($_GET["p"])) {
                if ($_GET["p"] === "o") { echo "ele"; }
                else if ($_GET["p"] === "a") { echo "ela"; }
                else { echo "elu"; }
            } else { echo "elu"; }
        
        ?>, mas queria mantê-la em segredo. Caso você ache que essa mensagem seja para você, digite a senha que eu te enviei para acessar sua mensagem :)</p>

        <section id="letter">
        <?php
        
            if(isset($_POST["pass"])) {
                if($_POST["pass"] == $people[$_GET["q"]]->get_pass()) {

                    if (!file_exists("letters/" . $people[$_GET["q"]]->get_pass() . ".html")) {
                        echo "<p>Parece que algum problema aconteceu. Chama o Speck.</p>";
                    } else {
                        $message = file_get_contents("letters/" . $people[$_GET["q"]]->get_pass() . ".html");
                        echo $message;
                    }

                } else {
                    echo "<p>Parece que a senha não está correta. Tente novamente.</p>";
                    echo '<form action="' . $_SERVER["REQUEST_URI"] . '" method="post"><input type=""password" id="pass" name="pass"><input type="submit" value="Submit"></form>';
                }
            } else {

                echo '<form action="' . $_SERVER["REQUEST_URI"] . '" method="post"><input type=""password" id="pass" name="pass"><input type="submit" value="Submit"></form>';

            }
        
        ?>
        <a href="/">Página Inicial</a>
        </section>
    </main>
    <footer>
        <p>Esse site foi desenvolvido com muito <span class="heart">amor</span> pelo Speck.</p>
    </footer>
</body>
</html>