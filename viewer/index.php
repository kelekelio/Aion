<?php

use PowerBook\ItemModel;
use PowerBook\ItemModelType;

require_once __DIR__ . '/app/bootstrap.php';

$genders  = [ItemModel::FEMALE,   ItemModel::MALE];
$factions = [ItemModel::ASMODIAN, ItemModel::ELYOS];



// viewer.php
$itemId = isset($_GET['item']) && ctype_digit((string) $_GET['item'])
    ? (int) $_GET['item']
    : null;

$gender = isset($_GET['gender']) && in_array($_GET['gender'], $genders)
    ? $_GET['gender']
    : ItemModel::FEMALE;

$faction = isset($_GET['faction']) && in_array($_GET['faction'], $factions)
    ? $_GET['faction']
    : ItemModel::ASMODIAN;

if (null === $itemId) {
    // invalid format
    throw new BadMethodCallException('Item identifier is malformed.');
}

if (null === $item = $services['app.repository.item_model']->find($itemId)) {
    die(sprintf('Item #%d not found.', $itemId));
}

$AionDir = $_SERVER['DOCUMENT_ROOT'];

$model = new ItemModel($item->getMesh(), in_array($item->getType(), ItemModelType::getTypesWithSexOrRace()));
if (file_exists($AionDir . '/viewer/models/' . $model->getSceneUrl($gender, $faction))) {
	$checkmodel = $model->getSceneUrl($gender, $faction);
}else {
	$checkmodel = $model->getSceneUrl($gender, 'elyos');
}
?>
<html>
    <body style="background-image: url('img/map_mask.png');background-repeat: no-repeat;">
        <canvas id="cv" width="587px" height="585px" style="padding-top: 56px; padding-left: 15px;">
        </canvas>
        <script type="text/javascript" src="js/jsc3d.js"></script>
        <script type="text/javascript" src="js/jsc3d.touch.js"></script>
        <script type="text/javascript">
            var viewer = new JSC3D.Viewer(document.getElementById('cv'));
            viewer.setParameter('SceneUrl', 'models/<?=$checkmodel ?>');
            viewer.setParameter('BackgroundColor1', '#11495a');
            viewer.setParameter('BackgroundColor2', '#3A93AE');
            viewer.setParameter('RenderMode', 'textureflat');
            viewer.setParameter('Definition', 'high');
            viewer.setParameter('InitRotationZ', '180');
            viewer.setParameter('InitRotationX', '90');
            viewer.setParameter('InitRotationY', '180');
            viewer.init();

        </script>
        <div>
            <form method="get" id="model-changer" style="padding-top: 7px; padding-left: 16px;">
                <input type="hidden" name="item" value="<?=$itemId?>">
				<?php if ($model->hasVariants()): ?>
                    <select name="faction" onchange="document.getElementById('model-changer').submit()">
                        <option value="asmodian" <?=$faction === ItemModel::ASMODIAN ? 'selected' : ''?>>Asmodian</option>
                        <option value="elyos"    <?=$faction === ItemModel::ELYOS    ? 'selected' : ''?>>Elyos</option>
                    </select>
                    <select name="gender" onchange="document.getElementById('model-changer').submit()">
                        <option value="female" <?=$gender === ItemModel::FEMALE ? 'selected' : ''?>>Female</option>
                        <option value="male"   <?=$gender === ItemModel::MALE   ? 'selected' : ''?>>Male</option>
                    </select>
                <?php endif; ?>



</form>
<div style="position: absolute;left: 570px;top: 610px;z-index: 10;">
<img src="img/right.png" value="left" onClick="viewer.rotate(0,-10,0);viewer.update();">
</div>
<div style="position: absolute;left: 30px;top: 610px;z-index: 10;">
<img src="img/left.png" value="left" onClick="viewer.rotate(0,10,0);viewer.update();">
</div>
<div style="position: absolute;left: 290px;top: 70px;z-index: 10;">
<img src="img/up.png" value="left" onClick="viewer.rotate(-10,0,0);viewer.update();">
</div>
<div style="position: absolute;left: 290px;top: 610px;z-index: 10;">
<img src="img/down.png" value="left" onClick="viewer.rotate(10,0,0);viewer.update();">
</div>
<div style="position: absolute;left: 570px;top: 70px;z-index: 10;">
<img src="img/aclock.png" value="left" onClick="viewer.rotate(0,0,10);viewer.update();">
</div>
<div style="position: absolute;left: 30px;top: 70px;z-index: 10;">
<img src="img/clock.png" value="left" onClick="viewer.rotate(0,0,-10);viewer.update();">
</div>
        </div>
    </body>
</html>
