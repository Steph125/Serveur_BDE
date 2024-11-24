const express = require('express');
const bcrypt = require('bcrypt');
const Model = require('../model/UserModel');

module.exports = (app) => {
  app.post('/', (req, res) => {
    const { id, password } = req.body;

    Model.getUserById(id, (error, user) => {
      if (error) {
        console.error('Error retrieving user:', error);
        return res.status(500).json({ message: 'Internal server error' });
      }

      if (!user) {
        return res.status(401).json({ message: 'Invalid user ID!' });
      } 

      bcrypt.compare(password, user.password)
        .then((isPasswordValid) => {
          if (!isPasswordValid) {
            return res.status(401).json({ message: 'Invalid password!' });
          }
 
          const message = 'The user has been successfully logged in';
          return res.json({ message, data: user });
        })
        .catch((error) => {
          console.error('Error comparing passwords:', error);
          return res.status(500).json({ message: 'Internal server error' });
        });
    });
  });
};
