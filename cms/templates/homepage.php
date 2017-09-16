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

<?php } ?>

      </ul>

<script type="text/javascript">
var scene, camera, renderer;

var WIDTH  = window.innerWidth;
var HEIGHT = window.innerHeight;

var SPEED = 0.01;




var  Articles = <?php print json_encode($data); ?>;

function init() {
    scene = new THREE.Scene();

    addGeometry();
    initCamera();
    initRenderer();

    document.body.appendChild(renderer.domElement);
}

function initCamera() {
    camera = new THREE.PerspectiveCamera(70, WIDTH / HEIGHT, 1, 10);
    camera.position.set(0, 3.5, 5);
    camera.lookAt(scene.position);
}

function initRenderer() {
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(WIDTH, HEIGHT);
}

function addGeometry() {
    var geometry = new THREE.Mesh(new THREE.CubeGeometry(10, 10, 10));
    var material = new THREE.MeshNormalMaterial();
    console.log(Articles.length);
for (var i=0; i < Articles.length; i++){
  var mesh = new THREE.Mesh( geometry, material );
     mesh.position.x = ( Math.random() - 0.5 ) * 1000;
     mesh.position.y = ( Math.random() - 0.5 ) * 1000;
     mesh.position.z = ( Math.random() - 0.5 ) * 1000;
     mesh.updateMatrix();
     mesh.matrixAutoUpdate = false;
     scene.add( mesh );
}


}

/*function rotateCube() {
    mesh.rotation.x -= SPEED * 2;
    mesh.rotation.y -= SPEED;
    mesh.rotation.z -= SPEED * 3;
}*/

function render() {
    requestAnimationFrame(render);
    //rotateCube();
    renderer.render(scene, camera);

    for( i in Articles ) {
    console.log( Articles[i].length );
    //console.log( "length: "+Articles.length );
  }
}

init();
render();
</script>



      <p><a href="./?action=archive">Article Archive</a></p>

<?php include "templates/include/footer.php" ?>
