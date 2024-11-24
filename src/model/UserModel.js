const db = require('../config/database');
// const sqlString = require('sqlstring');

const UserModel = {
  getAllUsers: (callback) => {
    db.query('SELECT * FROM user', callback);
  },
  getUserById: (id, callback) => {
    db.query('SELECT * FROM user WHERE id = ?', id, (error, results) => {
      if (error) {
        callback(error, null);
        return;
      }
      callback(null, results[0]);
    });
  },
  createUser: (mail, nom_u, prenom_u, password, localisation, callback) => {
    db.query(
      'INSERT INTO user (mail, nom_u, prenom_u, password, localisation) VALUES (?, ?, ?, ?, ?)',
      [mail, nom_u, prenom_u, password, localisation],
      callback
    );
  },
  updateUser: (id, nom_u, prenom_u, password, localisation, statut, callback) => {
    db.query(
      'UPDATE user SET nom_u = ?, prenom_u = ?, password = ?, localisation = ?, statut = ? WHERE id = ?',
      [nom_u, prenom_u, password, localisation, statut, id],
      callback
    );
  },
  deleteUser: (id, callback) => {
    db.query('DELETE FROM user WHERE id = ?', id, callback);
  },
  getUserByEmail: (email, password, callback) => {
    const query = 'SELECT * FROM user WHERE mail = ? AND password = ?';
    const values = [email, password];
    db.query(query, values, (error, results) => {
      if (error) {
        return callback(error);
      }

      if (results.length === 0) {
        return callback(null, null);
      }

      const user = results[0];
      return callback(null, user);
    });
  }
};

module.exports = UserModel;