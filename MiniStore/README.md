# BackEndEval

## Le cœur du projet
Ministore est un projet qui consiste à créer un site e-commerce pour vendre notamment des montres ou des téléphones à des prix très compétitifs.

## Comment accéder à ce projet
Dans un premier temps, dans un terminal, entrez la commande `git clone https://github.com/BenoitDeud/BackEndEval.git` pour obtenir le projet. Une fois le projet téléchargé, lancez votre éditeur de code (VSCode, etc.), ouvrez le dossier et choisissez le projet ministore. Ensuite, lancez un terminal depuis le dossier ministore et entrez la commande `composer install` afin d'installer les dossiers qui ont été ignorés par GitHub. Il est également nécessaire que Composer soit installé sur votre ordinateur.
Ensuite, dans le terminal, utilisez la commande `symfony server:start` pour lancer le serveur.
La base de données est également disponible et le compte admin est jesuidds@outlook.fr avec le mot de passe JEsuis02@.

## Description du projet
La page d'accueil présente différents articles à travers des cartes ou un carrousel. Il y a dans l'en-tête différents boutons qui permettent à l'utilisateur de naviguer à travers le site.

### La page d'inscription
La page d'inscription permet à l'utilisateur de créer un compte en indiquant les informations nécessaires.

### La page de connexion
Elle permet à l'utilisateur de se connecter sur le site en indiquant son adresse mail et son mot de passe.

### La page produits
Cette page regroupe tous les articles disponibles sur notre site, y compris des téléphones et des montres. L'utilisateur a accès à un filtre pour choisir une catégorie de produit ou en tapant dans la barre de recherche.
L'utilisateur peut voir les produits, choisir une quantité et l'ajouter à son panier. Il peut, s'il le souhaite, obtenir plus d'informations en cliquant sur le bouton associé et voir s'afficher une fenêtre modale avec une description du produit. Si le produit n'est plus disponible, le bouton d'ajout au panier sera grisé et ne pourra plus être cliqué.

### La page panier
Cette page regroupe les articles que l'utilisateur a choisis ainsi que leurs quantités. Il peut, s'il le souhaite, supprimer un article de son panier ou le vider totalement.

### La page livraison
Après la validation du panier, l'utilisateur doit choisir son adresse de livraison. Il a le choix entre son adresse, une adresse qu'il souhaite ou bien une adresse point relais via l'API Mondial Relay.

### La page récapitulatif
Une fois l'adresse de livraison choisie, l'utilisateur voit le récapitulatif de la commande avec l'ID, la référence de la commande, les articles, l'adresse de livraison et le montant total de la commande.

## Les pages liées au profil
### La page profil
L'utilisateur peut voir sa photo de profil, il en aura une par défaut qu'il pourra changer, ses informations et des boutons qui lui permettront de changer certaines de ses informations.

### Les pages de changements
L'utilisateur peut changer son pseudo, son mot de passe, son adresse, sa photo de profil s'il le souhaite.

### La page commande de l'utilisateur
L'utilisateur peut voir l'historique de ses commandes avec l'ID visible et ensuite il peut cliquer sur la fenêtre modale pour avoir tous les détails de la commande.

# Le panel admin EasyAdmin
## Ce qu'il permet à l'admin de faire
L'admin peut ajouter de nouvelles catégories d'objets, il peut ajouter de nouveaux produits, il peut voir dans une certaine limite les informations des utilisateurs, voir l'historique et les références des commandes, il peut également ajouter des liens dans la barre de navigation et changer le logo.

# Conclusion
Il s'agit d'un projet qui a demandé un peu de temps et qui va perdurer dans le temps. Il subira des modifications en adéquation avec les compétences que je vais acquérir au fil du temps.

# IN ENGLISH

# BackEndEval

## The heart of the project
Ministore is a project that consists of creating an e-commerce site to sell items such as watches or phones at very competitive prices.

## How to access this project
First, in a terminal, enter the command `git clone https://github.com/BenoitDeud/BackEndEval.git` to get the project. Once the project is downloaded, launch your code editor (VSCode, etc.), open the folder and choose the ministore project. Then, launch a terminal from the ministore folder and enter the command `composer install` to install the folders that were ignored by GitHub. It is also necessary that Composer is installed on your computer.
Then, in the terminal, use the command `symfony server:start` to start the server.
The database is also available and the admin account is jesuidds@outlook.fr with the password JEsuis02@.

## Project Description
The homepage displays different items through cards or a carousel. There are different buttons in the header that allow the user to navigate through the site.

### The register page
The register page allows the user to create an account by providing the necessary information.

### The login page
It allows the user to log in to the site by entering their email address and password.

### The products page
This page includes all the items available on our site, including phones and watches. The user has access to a filter to choose a product category or by typing in the search bar.
The user can view the products, choose a quantity, and add it to their cart. They can, if they wish, get more information by clicking on the associated button and see a modal window with a description of the product. If the product is no longer available, the add to cart button will be grayed out and cannot be clicked.

### The shopping cart page
This page includes the items that the user has chosen as well as their quantities. They can, if they wish, remove an item from their cart or empty it completely.

### The delivery page
After validating the cart, the user must choose their delivery address. They have the choice between their address, an address they want, or a relay point address via the Mondial Relay API.

### The summary page
Once the delivery address is chosen, the user sees the order summary with the order ID, the order reference, the items, the delivery address, and the total amount of the order.

## Pages linked to the profile
### The profile page
The user can see their profile picture, they will have a default one that they can change, their information, and buttons that will allow them to change some of their information.

### Change pages
The user can change their username, password, address, profile picture if they wish.

### The user's order page
The user can see the history of their orders with the visible ID and then they can click on the modal window to get all the details of the order.

# The EasyAdmin admin panel
## What it allows the admin to do
The admin can add new object categories, they can add new products, they can see to a certain extent the information of the users, see the history and references of the orders, they can also add links in the navbar and change the logo.

# Conclusion
This is a project that took some time and will continue over time. It will undergo changes in line with the skills I will acquire over time.