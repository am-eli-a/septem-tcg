# 🃏 Septem TCG

> Jeu de cartes à collectionner de l'association **Septem 24** : les personnages des courts métrages et les visages de l'association, réunis en cartes.

[![Version](https://img.shields.io/badge/version-V1-E8508A?style=for-the-badge)](https://septem-tcg.ameliadev.fr/)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)

🌐 **Site en ligne : [septem-tcg.ameliadev.fr](https://septem-tcg.ameliadev.fr/)**

<!-- TODO : ajouter une capture d'écran de la page d'accueil et d'un booster
![Aperçu](docs/apercu.png)
-->

---

## ✨ Le principe

Chaque membre validé peut ouvrir des **boosters de 5 cartes** et remplir sa collection. Les cartes représentent les personnages des courts métrages de Septem 24 et les membres de l'association.

- 🎁 **5 cartes par booster**, un booster disponible **toutes les 5 heures**
- 📚 **Collection personnelle** : les trous montrent les cartes qu'il reste à trouver
- 🖼️ **Galerie publique** des personnages, ouverte à tous les visiteurs
- 🔐 **Comptes** avec validation manuelle : l'ouverture des boosters et les cartes des membres sont réservées aux membres validés

### Les raretés

| Rareté | Chance de sortir |
|--------|:----------------:|
| Commun | 70 % |
| Rare | 15 % |
| Epic | 8 % |
| Légendaire | 5 % |
| Unique | 2 % |

---

## 👥 Utilisation actuelle

La V1 est en production et utilisée par une **trentaine d'utilisateurs**, membres de l'association.

---

## 🛠️ Stack technique

| Domaine | Technologies |
|---------|--------------|
| Back-end | PHP, Laravel |
| Front-end | Livewire, Blade, HTML, CSS |
| Hébergement | Railway |
| Domaine & DNS | Cloudflare |
| Versionnement | Git, GitHub |

---

## 🗺️ Roadmap

- [x] **V1** : comptes, validation par un membre, collection, boosters toutes les 5 heures, galerie publique
- [ ] **V2** (pistes)
  - Dashboard pour le validateur (validations, création des générations de cartes)
  - Dashboard utilisateur (mot de passe, mail)
  - Page galerie des membres
  - Page de présentation de l'association
  - Changement de sleeve de booster
- [ ] **Plus tard** (pistes)
  - Échanges entre membres
  - Boosters offerts et boosters cumulables
  - Différents types de boosters (génération 1, génération 2…)
  - Mode de création de cartes
  - PWA et mode hors connexion

---

## 📄 Contexte

Projet bénévole réalisé pour l'association **Septem 24**, avec analyse des besoins et retours réguliers de l'association.

## 👩‍💻 Auteure

**Amelia Dufour-Lazrek**, étudiante en BUT Informatique
[GitHub](https://github.com/am-eli-a) · [LinkedIn](https://www.linkedin.com/in/am-eli-a)
