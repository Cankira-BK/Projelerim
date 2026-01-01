<?php
class CategoryController {
    public function index() {
        $db = \StaticDatabase\StaticDatabase::init();
        $categories = $db->query("SELECT * FROM admin_categories ORDER BY parent_id ASC, id ASC")->fetchAll(PDO::FETCH_ASSOC);
        include(__DIR__ . "/../../views/admin/category/index.php");
    }

    public function create() {
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            header("Location: /admin/category");
            exit;
        }

        $name = trim($_POST['name']);
        $parent_id = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : null;
        $slug = strtolower(preg_replace('/[^a-z0-9]+/', '-', $name));

        $db = \StaticDatabase\StaticDatabase::init();
        $stmt = $db->prepare("INSERT INTO admin_categories (name, slug, parent_id) VALUES (?, ?, ?)");
        $stmt->execute([$name, $slug, $parent_id]);

        // View klasörü oluştur
        $path = __DIR__ . "/../../views/admin/" . $slug;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            $content = "<?php include('../header.php'); ?>\n";
            $content .= "<div class='content-wrapper'>\n";
            $content .= "  <section class='content-header'><h1>" . htmlspecialchars($name) . "</h1></section>\n";
            $content .= "  <section class='content'><p>FTP üzerinden düzenleyebilirsin.</p></section>\n";
            $content .= "</div>\n";
            $content .= "<?php include('../footer.php'); ?>";
            file_put_contents($path . "/index.php", $content);
        }

        header("Location: /admin/category");
    }

    public function delete($id) {
        $db = \StaticDatabase\StaticDatabase::init();
        $stmt = $db->prepare("DELETE FROM admin_categories WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: /admin/category");
    }
}
