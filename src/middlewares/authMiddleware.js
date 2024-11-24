const jwt = require('jsonwebtoken');
const privateKey = process.env.CUSTOM_PRIVATE_KEY; // Modification: Récupération de la clé privée depuis les variables d'environnement

module.exports = (req, res, next) => {
    const authorizationHeader = req.headers.authorization;
    if (!authorizationHeader) {
        const message = 'Vous n\'avez pas fourni de jeton d\'authentification. Ajoutez-en un dans l\'en-tête de la requête.';
        return res.status(401).json({ message });
    }

    const token = authorizationHeader.split(' ')[1]; // Correction: Séparation de la chaîne de l'en-tête pour obtenir le token
    jwt.verify(token, privateKey, (error, decodedToken) => {
        if (error) {
            const message = 'L\'utilisateur n\'est pas autorisé à accéder à cette ressource.';
            return res.status(401).json({ message, data: error });
        }

        // Modification: Envoi du token dans la réponse JSON
        res.locals.userId = decodedToken.user_id; // Modification: Stockage de l'ID de l'utilisateur dans locals
        next();
    });
};
