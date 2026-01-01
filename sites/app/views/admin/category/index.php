<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include("../header.php"); ?>
<?php
$db = \StaticDatabase\StaticDatabase::init();
$categories = $db->query("SELECT * FROM admin_categories ORDER BY parent_id ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Kategori Yönetimi</h1>
  </section>
  <section class="content">

    <!-- Yeni kategori formu -->
    <form method="POST" action="/admin/category/create" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Kategori adı" required>
      </div>
      <div class="form-group">
        <select name="parent_id" class="form-control">
          <option value="">Ana Kategori</option>
          <?php foreach($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-success">Ekle</button>
    </form>

    <hr>

    <!-- Kategori listesi -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Kategori Adı</th>
          <th>Slug</th>
          <th>Üst Kategori</th>
          <th>İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($categories as $cat): ?>
          <tr>
            <td><?php echo $cat['id']; ?></td>
            <td><?php echo $cat['name']; ?></td>
            <td><?php echo $cat['slug']; ?></td>
            <td><?php echo $cat['parent_id'] ? $cat['parent_id'] : 'Ana Kategori'; ?></td>
            <td>
              <a href="/admin/category/delete/<?php echo $cat['id']; ?>" class="btn btn-danger btn-sm">Sil</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </section>
</div>
<?php include("../footer.php"); ?>
