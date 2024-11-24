// panierController.js
const panierModel = require('../model/PanierModel');

const panierController = {
    getPanier: (req, res) => {
        const userId = req.user.id; // Récupérer l'ID de l'utilisateur connecté depuis le middleware d'authentification
        panierModel.getPanierByUserId(userId, (error, panier) => {
            if (error) {
                console.error('Error fetching panier:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json(panier);
        });
    },
    addProductToPanier: (req, res) => {
        const userId = req.user.id;
        const { productId, quantity } = req.body;
        panierModel.addToPanier(userId, productId, quantity, (error, result) => {
            if (error) {
                console.error('Error adding product to panier:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json({ message: 'Product added to panier' });
        });
    },
    removeProductFromPanier: (req, res) => {
        const userId = req.user.id;
        const { productId } = req.body;
        panierModel.removeFromPanier(userId, productId, (error, result) => {
            if (error) {
                console.error('Error removing product from panier:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json({ message: 'Product removed from panier' });
        });
    },
    finalizeOrder: (req, res) => {
        const userId = req.user.id;
        panierModel.finalizeOrder(userId, (error, result) => {
            if (error) {
                console.error('Error finalizing order:', error);
                res.status(500).send('Internal Server Error');
                return;
            }
            res.json({ message: 'Order finalized' });
        });
    }
};

module.exports = panierController;
