const express = require('express');
const morgan = require('morgan');
const favicon = require('serve-favicon');
const path = require('path');
const cors = require('cors');
const boutiqueRoutes = require('./src/routes/boutiqueRoutes');
const UserRoutes = require('./src/routes/UserRoutes');
const Login = require('./src/routes/Login');
const PanierRoutes = require('./src/routes/PanierRoutes')
const notificationRoutes = require('./src/routes/NotificationRoutes');
const ideaRoutes = require('./src/routes/IdeasRoutes');
const EventRoutes = require('./src/routes/EventRoutes');
const inscriptionRoutes = require('./src/routes/InscriptionRoute')

const app = express();
const port = 3000;

// Middlewares
app.use(morgan('dev'));
app.use(express.json());
app.use(cors());
app.use(express.urlencoded({ extended: true}));
app.use(favicon(path.join(__dirname, 'favicon.ico')));
app.use('/images', express.static(path.join(__dirname, 'images')));

// Routes
app.use('/shop', boutiqueRoutes);
app.use('/user', UserRoutes);
app.use('/login', Login);
app.use('/panier', PanierRoutes);
app.use('/notif', notificationRoutes);
app.use('/idea', ideaRoutes);
app.use('/event', EventRoutes);
app.use('/inscription', inscriptionRoutes);

// module.exports = app;

app.listen(port, () => {
    console.log(`Our app is launched on : http://localhost:${port}`);
});