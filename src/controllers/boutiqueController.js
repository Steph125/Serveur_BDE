const boutiqueModel = require('../model/boutiqueModel');

const boutiqueController = {
    getAllProducts: (req, res) => {
        boutiqueModel.getAllProducts((error, data) => {
            if (error) {
                console.error('Error fetching products:', error);
                return res.status(500).json({ error: 'Internal Server Error' });
            }
            res.json(data);
        });
    },
    getProductById: (req, res) => {
        const id = req.params.id;
        boutiqueModel.getProductById(id, (error, result) => {
            if (error) {
                console.error('Error fetching product:', error);
                return res.status(500).json({ error: 'Internal Server Error' });
            }
            if (!result) {
                return res.status(404).json({ error: 'Product not found' });
            }
            res.json(result);
        });
    },
    createProduct: (req, res) => {
        const { id, nom_a, description_a, categorie, image, prix, nbreCommande } = req.body;
        boutiqueModel.createProduct(id, nom_a, description_a, categorie, image, prix, nbreCommande, (error, result) => {
            if (error) {
                console.error('Error creating product:', error);
                return res.status(500).json({ error: 'Internal Server Error' });
            }
            res.json({ id, nom_a, description_a, categorie, image, prix, nbreCommande });
        });
    },
    updateProduct: (req, res) => {
        const id = req.params.id;
        const { nom_a, description_a, categorie, image, prix, nbreCommande } = req.body;
        boutiqueModel.updateProduct(id, nom_a, description_a, categorie, image, prix, nbreCommande, (error, result) => {
            if (error) {
                console.error('Error updating product:', error);
                return res.status(500).json({ error: 'Internal Server Error' });
            }
            res.json({ id, nom_a, description_a, categorie, image, prix, nbreCommande });
        });
    },
    deleteProduct: (req, res) => {
        const id = req.params.id;
        boutiqueModel.deleteProduct(id, (error, result) => {
            if (error) {
                console.error('Error deleting product:', error);
                return res.status(500).json({ error: 'Internal Server Error' });
            }
            res.json({ message: 'Product deleted successfully' });
        });
    },
    getMostOrderedProducts: (req, res) => {
        boutiqueModel.getMostOrderedProduct((error, result) => {
            if (error) {
                console.error('Error fetching most ordered products:', error);
                return res.status(500).json({ error: 'Internal Server Error' });
            }
            res.json(result);
        });
    },
    searchProducts: (req, res) => {
        const { query, minPrice, category } = req.query;
        boutiqueModel.searchProducts(query, minPrice, category, (error, results) => {
            if (error) {
                console.error('Error searching products:', error);
                return res.status(500).json({ error: 'Internal Server Error' });
            }
            res.json(results);
        });
    }
};
 
module.exports = boutiqueController;
