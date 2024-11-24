const db = require('../config/database');

const boutiqueModel = {
    getAllProducts: (callback) => {
        db.query('SELECT * FROM articles ORDER BY id DESC', callback);
    },
    getProductById: (id, callback) => {
        db.query('SELECT * FROM articles WHERE id = ?', [id], (error, results) => {
            if (error) {
                callback(error, null);
                return;
            }
            callback(null, results[0]);
        });
    },
    createProduct: (nom_a, description_a, categorie, image, prix, nbreCommandes, callback) => {
        db.query('INSERT INTO articles (nom_a, description_a, categorie, image, prix, nbreCommandes) VALUES (?, ?, ?, ?, ?, ?)', [nom_a, description_a, categorie, image, prix, nbreCommandes], callback);
    },
    updateProduct: (id, nom_a, description_a, categorie, image, prix, nbreCommandes, callback) => {
        db.query('UPDATE articles SET nom_a = ?, description_a = ?, categorie = ?, image = ?, prix = ?, nbreCommandes = ? WHERE id = ?', [nom_a, description_a, categorie, image, prix, nbreCommandes, id], callback);
    },
    deleteProduct: (id, callback) => {
        db.query('DELETE FROM articles WHERE id = ?', [id], callback);
    },
    getMostOrderedProduct: (callback) => {
        db.query('SELECT product_id, COUNT(*) AS order_count FROM orders GROUP BY product_id ORDER BY order_count DESC LIMIT 3', callback);
    },
    searchProducts: (query, minPrice, category, callback) => {
        let sql = 'SELECT * FROM articles WHERE 1=1';

        // Ajout des filtres de recherche si des valeurs sont fournies
        if (query) {
            sql += ` AND nom_a LIKE '%${query}%'`;
        }
        if (minPrice) {
            sql += ` AND prix >= ${minPrice}`;
        }
        if (category) {
            sql += ` AND categorie = ${category}`;
        }

        db.query(sql, callback);
    }
};

module.exports = boutiqueModel;