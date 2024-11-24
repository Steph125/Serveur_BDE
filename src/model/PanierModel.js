const db = require('../config/database');

const panierModel = {
    getPanierByUserId: (userId, callback) => {
        db.query('SELECT * FROM panier WHERE user_id = ?', userId, callback);
    },
    addToPanier: (userId, productId, quantity, callback) => {
        db.query('SELECT price, quantity_available FROM products WHERE id = ?', productId, (error, results) => {
            if (error) {
                callback(error, null);
                return;
            }
            
            const price = results[0].price;
            const quantityAvailable = results[0].quantity_available;
            
            if (quantity > quantityAvailable) {
                const message = "La quantité demandée est supérieure à la quantité disponible.";
                callback(message, null);
                return;
            }
            
            // Insérer le produit dans le panier avec le prix unitaire et la quantité disponible récupérés
            db.query('INSERT INTO panier (user_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)', [userId, productId, quantity, price], callback);
        });
    },
    removeFromPanier: (userId, productId, callback) => {
        db.query('DELETE FROM panier WHERE user_id = ? AND product_id = ?', [userId, productId], callback);
    },
    finalizeOrder: (userId, callback) => {
        db.query('SELECT price, quantity FROM products WHERE id = ?', productId, (error, results) => {
            if (error) {
                callback(error, null);
                return;
            }
            
            const price = results[0].price;
            const quantity = results[0].quantity;

            function calculerMontantTotal(price, quantity) {
                return price * quantity;
            }

            // Remplacez les valeurs ci-dessous par les prix unitaires et quantités réels
            const priceTransat = results[0].price;
            const quantityChs = results[0].quantity;

            const montantTotal = calculerMontantTotal(priceTransat, quantityChs);
            console.log(`Montant total : ${montantTotal} frs`); // Utilisation des backticks pour l'interpolation de chaînes
        });
    }
};

module.exports = panierModel;
