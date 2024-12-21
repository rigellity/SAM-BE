<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corememories"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
    SELECT 
        ip.islandOfPersonalityID,
        ip.name AS islandName,
        ip.shortDescription,
        ip.color,
        ic.image,
        ic.content
    FROM 
        islandsofpersonality ip
    LEFT JOIN 
        islandcontents ic ON ip.islandOfPersonalityID = ic.islandOfPersonalityID
";
$result = $conn->query($sql);

$islands = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $islands[$row['islandOfPersonalityID']]['name'] = $row['islandName'];
        $islands[$row['islandOfPersonalityID']]['description'] = $row['shortDescription'];
        $islands[$row['islandOfPersonalityID']]['color'] = $row['color'];
        $islands[$row['islandOfPersonalityID']]['contents'][] = [
            'image' => $row['image'],
            'content' => $row['content']
        ];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rigelle's Island of Personality</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;700&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Cookie&display=swap');

body {
    font-family: 'Cookie';
    background-image: url('https://images4.alphacoders.com/709/709841.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: white;
    margin: 0;
    padding: 0;
}

header {
    text-align: center;
    padding: 30px 0;
}

header h1 {
    font-family: 'Century Gothic';
    font-size: 100px; 
    font-weight: bold;
    color: rgb(115, 65, 118);
}

.buttons-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin: 30px 0;
}

.buttons-row button {
    padding: 15px 30px;
    font-size: 1.5vw;
    background-color: rgba(111, 145, 249, 0.69);
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 25px;
    transition: background-color 0.3s;
}

.buttons-row button:hover {
    background-color: #555;
}

.content-section {
    font-family: 'century gothic';
    margin: 30px auto;
    padding: 20px;
    border-radius: 10px;
    max-width: 90%; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.content-section img {
    max-width: 100%;
    border-radius: 10px;
    margin-bottom: 15px;
}

.rounded-image-section {
    text-align: center;
    margin: 30px 0;
}

.rounded-image-section img {
    width: 20vw; 
    height: 20vw; 
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto; 
    display: block;
}

@media (min-width: 768px) {
    .rounded-image-section img {
        width: 250px;
        height: 250px;
    }
}

    </style>
</head>
<body>

<header>
    <h1>Rigelle's Island of Personality</h1>
</header>
<div class="rounded-image-section">
    <img src="assets/img/me.jpg" alt="Image">
</div>
<div class="buttons-row">
    <?php foreach ($islands as $id => $island): ?>
        <button onclick="showIsland(<?php echo htmlspecialchars(json_encode($island)); ?>)">
            <?php echo $island['name']; ?>
        </button>
    <?php endforeach; ?>
</div>

<!-- Modal Section -->
<div id="islandModal" class="w3-modal">
    <div id="modalContent" class="w3-modal-content w3-animate-opacity">
        <div class="w3-container">
            <span onclick="closeModal()" class="w3-button w3-display-topright w3-large w3-hover-red">&times;</span>
            <div class="content-section">
                <h2 id="islandTitle"></h2>
                <p id="islandDescription"></p>
                <div id="islandContents"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function showIsland(island) {
        document.getElementById('islandTitle').innerText = island.name;
        document.getElementById('islandDescription').innerText = island.description;

        const modalContent = document.getElementById('modalContent');
        modalContent.style.backgroundColor = island.color || '#000'; 

        const contentsDiv = document.getElementById('islandContents');
        contentsDiv.innerHTML = ''; 

        if (island.contents) {
            island.contents.forEach(content => {
                const contentElement = document.createElement('div');
                contentElement.style.marginBottom = '20px';

                if (content.image) {
                    const img = document.createElement('img');
                    img.src = content.image;
                    contentElement.appendChild(img);
                }

                if (content.content) {
                    const paragraph = document.createElement('p');
                    paragraph.innerText = content.content;
                    contentElement.appendChild(paragraph);
                }

                contentsDiv.appendChild(contentElement);
            });
        }

        document.getElementById('islandModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('islandModal').style.display = 'none';
    }
</script>

</body>
</html>
