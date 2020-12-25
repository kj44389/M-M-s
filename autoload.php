<?php

require_once __DIR__ . './exceptions/autoloadExceptions.php';

require_once __DIR__ . './src/Validation.php';
require_once __DIR__ . './src/DataForm.php';

require_once __DIR__ . './templates/Layout.php';

// Hardware Views
require_once __DIR__ . './templates/HardwareViews/HardwareViewAdd.php';
require_once __DIR__ . './templates/HardwareViews/HardwareViewShow.php';
require_once __DIR__ . './templates/HardwareViews/HardwareViewSearch.php';

// Invoie Views
require_once __DIR__ . './templates/InvoiceViews/InvoiceViewShow.php';
require_once __DIR__ . './templates/InvoiceViews/InvoiceViewShowList.php';
require_once __DIR__ . './templates/InvoiceViews/InvoiceViewAdd.php';
require_once __DIR__ . './templates/InvoiceViews/InvoiceViewSearch.php';

// License Views
require_once __DIR__ . './templates/LicenseViews/LicenseViewAdd.php';
require_once __DIR__ . './templates/LicenseViews/LicenseViewShow.php';

// Doc Views
require_once __DIR__ . './templates/DocViews/DocViewAdd.php';
require_once __DIR__ . './templates/DocViews/DocViewShow.php';

// Controllers
require_once __DIR__ . './src/controllers/HardwareController.php';
require_once __DIR__ . './src/controllers/InvoiceController.php';
require_once __DIR__ . './src/controllers/LicenseController.php';
require_once __DIR__ . './src/controllers/DocController.php';

// Handlers
require_once __DIR__ . './src/handlers/HardwareHandler.php';
require_once __DIR__ . './src/handlers/InvoiceHandler.php';
require_once __DIR__ . './src/handlers/LicenseHandler.php';
require_once __DIR__ . './src/handlers/DocHandler.php';

require_once __DIR__ . './src/Gear.php';
require_once __DIR__ . './src/User.php';
require_once __DIR__ . './src/PurchaseInvoice.php';

require_once __DIR__ . './dbconfig.php';


// try {
//     $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     throw new ConnectDatabaseException($e->getMessage(), null, $e);
// }
