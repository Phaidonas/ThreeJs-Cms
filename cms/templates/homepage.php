<?php include "templates/include/header.php" ?>

      <ul id="headlines">

<?php foreach ( $results['articles'] as $article ) { ?>

        <li>
          <h2>
            <span class="pubDate"><?php echo date('j F', $article->publicationDate)?></span><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"><?php echo htmlspecialchars( $article->title )?></a>
          </h2>
          <p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>
        </li>

        <?php $data[] = array(
      "id"    =>  $article->id,
      "title"  =>  $article->title
    );
?>

<?php $stringJSON = json_encode($data);?>

<?php } ?>

      </ul>

<script type="text/javascript">
var scene, camera, renderer;

var WIDTH  = window.innerWidth;
var HEIGHT = window.innerHeight;

var SPEED = 0.01;
var mesh;
// Convert JSON String to JavaScript Object
  var Articles = [<?php echo $stringJSON; ?>];


function init() {
    scene = new THREE.Scene();

    addGeometry();
    initCamera();
    initRenderer();

    document.body.appendChild(renderer.domElement);
}

function initCamera() {
  camera = new THREE.PerspectiveCamera(70, WIDTH / HEIGHT, 1, 1000);
  camera.position.y = 150;
	camera.position.z = 350;
	camera.position.y = 150;

}

function initRenderer() {
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(WIDTH, HEIGHT);
}

function addGeometry() {
    var geometry = new THREE.BoxBufferGeometry(25, 25, 25);
    var material = new THREE.MeshBasicMaterial({color:0x00ff44});
    mesh = new THREE.Mesh( geometry, material );

for(var i = 0; i < Articles.length; i += 1){


    mesh.position.y =Math.random() * ((HEIGHT-10) - (HEIGHT+10));
    mesh.position.x =Math.random() * ((HEIGHT-10) - (HEIGHT+10));



     mesh.updateMatrix();
     mesh.matrixAutoUpdate = false;
     scene.add( mesh );

}

console.log(Articles.length);


}

function rotateCube() {
    mesh.rotation.x -= SPEED * 2;
    mesh.rotation.y -= SPEED;
    mesh.rotation.z -= SPEED * 3;
}

function render() {
    requestAnimationFrame(render);
    rotateCube();
    renderer.render(scene, camera);
}

init();
render();
</script>



      <p><a href="./?action=archive">Article Archive</a></p>

<?php include "templates/include/footer.php" ?>
