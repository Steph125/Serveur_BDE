const express = require('express');
const router = express.Router();
const boutiqueController = require('../controllers/boutiqueController');

router.get('/', boutiqueController.getAllProducts);
router.get('/:id', boutiqueController.getProductById);
router.post('/', boutiqueController.createProduct);
router.put('/:id', boutiqueController.updateProduct);
router.delete('/:id', boutiqueController.deleteProduct);
router.get('/OP', boutiqueController.getMostOrderedProducts);
router.get('/search', boutiqueController.searchProducts);

module.exports = router;
