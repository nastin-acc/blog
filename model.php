<?php 

	Class Model{

		private $server = "localhost";
		private $username = "root";
		private $password;
		private $db = "news";
		public static $conn;

		public function __construct(){
			try {
				
				$this->conn = new mysqli($this->server,$this->username,$this->password,$this->db);
			} catch (Exception $e) {
				echo "connection failed" . $e->getMessage();
			}
		}


        public function message($sql,$action)
        {

            if ($sql) {

                echo "<script>alert('Запись успешно $action')</script>";
                echo "<script>window.location.href = '../index.php';</script>";
            } else {

                echo "<script>alert('Запись не была $action');</script>";
                echo "<script>window.location.href = 'index.php';</script>";
            }
        }

		public function insert()
        {
            if (isset($_POST['submit'])) {

                    $title = $_POST['title'];
                    $name = $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], 'media/images/' . $_FILES['image']['name']);
                    $image = 'media/images/' . $name;
                    $description = $_POST['description'];
                    $sql = mysqli_query($this->conn, query: "INSERT INTO `news` (`id`, `title`, `date`, `image`, `description`) VALUES (NULL, '$title', CURRENT_TIMESTAMP, '$image', '$description')");

                    $this->message($sql,"добавлена");
                }
        }


		public function fetch(){

            $page=isset($_GET['page-select'])? $_GET['page-select']:1;
            $limit=3;
            $offset=$limit*($page-1);
            if (isset($_GET['sort'])){

                $sort=$_GET['sort'];

            } else{
                $sort="desc";
            }
			$data = null;
			$query = "SELECT * FROM news ORDER BY `date` $sort LIMIT $limit OFFSET $offset ";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}

			return $data;
		}


		public function delete($id){

            $sql = mysqli_query($this->conn, query:"DELETE FROM `news` where `id` = '$id'");
            $this->message($sql,"удалена");
		}


        public function edit($id){

            $data = null;
            $sql = mysqli_query($this->conn, query: "SELECT * FROM news WHERE id = '$id'");
            if ($sql) {
                while($row = $sql->fetch_assoc()){
                    $data = $row;
                }
            }
            return $data;
        }

		public function update($data){

            $sql = mysqli_query($this->conn, query:"UPDATE `news` SET `title`='$data[title]',`image`='$data[image]', `description`='$data[description]'  WHERE `id`='$data[id] '");

            $this->message($sql,"отредактирована");
		}


	}

 ?>