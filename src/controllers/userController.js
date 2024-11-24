const UserModel = require('../model/userModel');
const bcrypt = require('bcrypt');

const userController = {
    getAllUsers: (req, res) => {
        UserModel.getAllUsers((error, results) => {
            if (error) {
                console.error('Error fetching users:', error);
                return res.status(500).send('Internal Server Error');
            }
            res.json(results);
        });
    },
    getUserById: (req, res) => {
        const id = req.params.id;
        UserModel.getUserById(id, (error, result) => {
            if (error) {
                console.error('Error fetching user:', error);
                return res.status(500).send('Internal Server Error');
            }
            if (!result) {
                return res.status(404).send('User not found');
            }
            res.json(result);
        });
    },
    createUser: (req, res) => {
        const { mail, nom_u, prenom_u, password, localisation } = req.body;
        bcrypt.hash(password, 10, (err, hash) => {
            if (err) {
                console.error('Error hashing password:', err);
                return res.status(500).send('Internal Server Error');
            }
            UserModel.createUser(mail, nom_u, prenom_u, hash, localisation, (error, result) => {
                if (error) {
                    console.error('Error creating user:', error);
                    return res.status(500).send('Internal Server Error');
                }
                res.json({ id: result.insertId, mail, nom_u, prenom_u, localisation });
            });
        });
    },
    updateUser: (req, res) => {
        const id = req.params.id;
        const { nom_u, prenom_u, password, localisation, statut } = req.body;
        bcrypt.hash(password, 10, (err, hash) => {
            if (err) {
                console.error('Error hashing password:', err);
                return res.status(500).send('Internal Server Error');
            }
            UserModel.updateUser(id, nom_u, prenom_u, hash, localisation, statut, (error, result) => {
                if (error) {
                    console.error('Error updating user:', error);
                    return res.status(500).send('Internal Server Error');
                }
                res.json({ id, nom_u, prenom_u, localisation, statut });
            });
        });
    },
    deleteUser: (req, res) => {
        const id = req.params.id;
        UserModel.deleteUser(id, (error, result) => {
            if (error) {
                console.error('Error deleting user:', error);
                return res.status(500).send('Internal Server Error');
            }
            res.json({ message: 'User deleted successfully' });
        });
    }
};

module.exports = userController;