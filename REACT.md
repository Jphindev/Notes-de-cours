# React

Le JSX est une syntaxe créée par React permettant d'écrire du JavaScript. Il faut suivre quelques règles :

- deux composants doivent toujours être wrappés dans un seul composant parent <></> ou div,
- les noms des composants commencent par une majuscule,
- les balises des composants doivent être refermées.

## Lancer une app React

```bash
npx Create-react-app nom_du_projet
cd nom_du_projet
npm start
```

```bash
npm create vite@latest nom_du_projet -- --template react
cd nom_du_projet
npm install
npm run dev
```

## Imports

Toutes les fonctionnalités utilisées doivent être importées en début de code

- CSS

```javascript
import "./css/app.css"; en JS
```

```css
@import "./css/app.css" en CSS;
```

- Fonctions / composants

```jsx
import Menu from "./components/Menu";
```

- Images

```jsx
import monstera from '../assets/monstera.jpg’
```

- Hooks

```jsx
import React, { useEffect, useState } from "react";
```

- Fichiers

```jsx
import { plantList } from '../datas/plantList’
```

Différences par rapport à JS

- className (et pas class)
- htmlFor (et pas for)
- defaultValue (et pas value)

## Components

Structure d’un composant

```jsx
// Header.jsx
export default function Header() {
  const pageTitle = "Titre de la page"
  return (
    <>
      <h1 className="title">{pageTitle}</h1>
      <ul className="menu">
        <li key={key unique pour chaque élément}>Menu 1</li>
        <li key={une autre key}>Menu 2</li>
      </ul>
    </>
  )
}
```

Ces components peuvent être appelés par d’autres components

```jsx
// App.jsx
import Header from "./Header"
import Carousel from "./Carousel"
import Gallery from "./Gallery"

export defaut function App() {
  return (
    <>
      <Header />
      <Carousel />
      <Gallery />
    </>
  )
}
```

Dans ce cas, le composant App est le parent des composants enfants Header, Carousel et Gallery.  
C’est au parent d’importer les enfants.

## Props

Les props sont des propriétés que l’on ajoute lors de l’appel d’un component pour transmettre des fonctions ou valeurs entre un parent et son enfant en utilisant des clés=valeurs.  
Un enfant ne peut pas changer la valeur d’une clé.

```jsx
// App.jsx

<Header *props* />

<Header cle1="valeur1" cle2={valeur2} />

<Header>
  <Props />
</Header>
```

```jsx
// Header.jsx

export default function Header(props){}

export default function Header({cle1, cle2}){}

export default function Header({children}){
  return <div>{children}</div>}
```

Exemple concret

```jsx
//Parent.js
import { plantList } from "../datas/plantList";
import Enfant from "./Enfant";
import "../styles/Parent.css";

export default function Parent() {
	function handleTruc() {
		console.log("Hello");
	}
	return;
	<ul className="lmj-plant-list">
		{plantList.map((plant) => (
			<Enfant
				id={plant.id}
				cover={plant.cover}
				name={plant.name}
				fctTruc={handleTruc}
			/> //props
		))}
	</ul>;
}
```

```jsx
//PlantItem.js
import "../styles/PlantItem.css";

export default function Enfant({ id, cover, name, fctTruc }) {
	return (
		<li key={id} className="lmj-plant-item">
			<img className="lmj-plant-item-cover" src={cover} alt={`${name} cover`} />
			{name}
			<button onClick={fctTruc}>Click me</button>
		</li>
	);
}
```

Pour écrire du JavaScript dans le jsx du composant on utilise : {`...`}
Dans les listes ou les tableaux, chaque key doit être unique.

On peut réfléchir à l’envers quand un enfant à besoin d’une fonction:

- on appelle la fonction qui n’existe pas encore

```jsx
onClick = { fctTruc };
```

- on la met dans les props de l’enfant

```jsx
function Enfant ({fctTruc})
```

- on la met en props à l’appel de l’enfant dans le component Parent

```jsx
<Enfant fctTruc={handleTruc} />
```

- on déclare la fonction dans le Parent

```jsx
function handleTruc () {…}
```

Quand il faut gérer des paramètres avec la fonction, on utilisera une fonction fléchée

```jsx
onClick={() ⇒ fctTruc(param)}
```

## Router Routes Route root

Création des paths

```jsx
//index.jsx
import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Home from "./pages/Home";
import Survey from "./pages/Survey";
import Header from "./components/Header";
import Error from "./components/Error";

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
	<React.StrictMode>
		<Router>
			<Header />
			<Routes>
				<Route path="/" element={<Home />} />
				<Route path="/survey" element={<Survey />} />
				<Route path="\*" element={<Error />} />
			</Routes>
		</Router>
	</React.StrictMode>
);
```

```jsx
// Header.jsx
import { Link } from "react-router-dom";

export default function Header() {
	return (
		<nav>
			<Link to="/">Accueil</Link>
			<Link to="/survey">Questionnaire</Link>
		</nav>
	);
}
```

## Hooks

### useState()

```jsx
const [inputValue, setInputValue] = useState(Valeur_initiale);
```

On pourra changer la valeur de inputValue grâce à setInputValue. useState() définit la valeur par défaut de inputValue.

```jsx
import { useState } from "react";

export default function QuestionForm() {
	const [inputValue, setInputValue] = useState("Posez votre question ici");
	return (
		<div>
			<textarea
				value={inputValue}
				onChange={(e) => setInputValue(e.target.value)}
			/>
		</div>
	);
}
```

### useEffect()

Permet d’activer un effet quand sa dépendance change

```jsx
useEffect(() => {
	document.title = `LMJ: ${total}€ d'achats`;
}, [total]);
```

Le titre du site est mis à jour quand la valeur de la variable total change. Si la dépendance est vide [ ], l’effet s’exécutera uniquement au 1er rendu du component.

Exemple: sauvegarde dans le localStorage

```jsx
function App() {
  const savedCart = localStorage.getItem('cart')
  const [cart, updateCart] = useState(savedCart ? JSON.parse(savedCart) : [])
  useEffect(() => {
    localStorage.setItem('cart', JSON.stringify(cart))
  }, [cart])

    return ()
}
```

Exemple: utilisation de useEffect pour afficher un loading pendant un fetch:

```jsx
export default function Survey() {
  const { questionNumber } = useParams();
  const [quest, setQuest] = useState({});
  const [isDataLoading, setDataLoading] = useState(false);

  useEffect(() => {
    // fetchData()
    setDataLoading(true); // pendant le chargement du fetch
    fetch(`http://localhost:8000/survey`)
      .then((response) => response.json())
      .then(({ surveyData }) => {
        setQuest(surveyData);
        setDataLoading(false); // fetch terminé
      })
    }, []);

  return (
    <SurveyContainer />
    <QuestionTitle>Question {questionNumber}</QuestionTitle>
    {isDataLoading ? (
      <Loader /> // le loader s'active quand le fetch est en cours
    ) : (
      <QuestionContent>{quest[questionNumber]}</QuestionContent>
    )})
```

### useParams()

Permet de récupérer la valeur d’une variable grâce à une URL.

```jsx
//index
<Route path="/survey/:questionNumber" element={<Survey />} />
```

```jsx
//Header
<Link to="/survey/42">Questionnaire</Link>
```

```jsx
//Survey
import { useParams } from "react-router-dom";

export default function Survey() {
	const { questionNumber } = useParams();
	return (
		<div>
			<h1>Questionnaire</h1>
			<h2>Question {questionNumber}</h2>
		</div>
	);
}
```

Ainsi en allant sur /survey/42, “Question 42” s’affiche.

### useContext()

Permet d’utiliser des props sans passer par tous les enfants

```jsx
import { useState, createContext, useContext } from "react";
import ReactDOM from "react-dom/client";

// On créé un contexte, ici c'est l'utilisateur (user)
const UserContext = createContext();

function Component1() {
	const [user, setUser] = useState("Jesse Hall");

	return (
		// on met la props dans le provider du contexte avec la clé value
		<UserContext.Provider value={user}>
			<h1>{`Hello ${user}!`}</h1>
			<Component2 />
		</UserContext.Provider>
	);
}

function Component2() {
	return (
		<>
			<h1>Component 2</h1>
			<Component3 />
		</>
	);
}

function Component3() {
	// on récupère la props sans passer par Component2
	const user = useContext(UserContext);

	return (
		<>
			<h1>Component 5</h1>
			// on appelle la valeur du props ici
			<h2>{`Hello ${user} again!`}</h2>
		</>
	);
}
```

### Hook personnalisé useMachin()

Exemple: création d’un hook pour fetch une url

```jsx
import { useState, useEffect } from "react";

const useFetch = (url) => {
	const [data, setData] = useState(null);

	useEffect(() => {
		fetch(url)
			.then((res) => res.json())
			.then((data) => setData(data));
	}, [url]);

	return [data];
};

export default useFetch;
import useFetch from "./useFetch";

const Home = () => {
	const [data] = useFetch("<https://jsonplaceholder.typicode.com/todos>");

	return (
		<>
			{data &&
				data.map((item) => {
					return <p key={item.id}>{item.title}</p>;
				})}
		</>
	);
};
```

## Méthodes

### map()

On transforme un tableau pour l’injecter en JSX dans la page

### reduce()

Permet de réaliser des opérations dans un tableau grâce à un accumulateur.

```jsx
const array1 = [1, 2, 3, 4];

// 0 + 1 + 2 + 3 + 4
const initialValue = 0;
const sumWithInitial = array1.reduce(
	(accumulator, currentValue) => accumulator + currentValue,
	initialValue
);

console.log(sumWithInitial);
// Expected output: 10
```

L’accumulateur va s’additionner à la valeur du tableau en cours et stocker cette nouvelle valeur, et faire ça pour chaque valeur du tableau. initialValue est la valeur de départ de l’accumulateur.

```jsx
const categories = plantList.reduce(
	(acc, plant) =>
		acc.includes(plant.category) ? acc : acc.concat(plant.category),
	[]
);
```

Si la catégorie de plante est déjà dans l’accumulateur, celui-ci reste inchangé, sinon on ajoute la catégorie dans le tableau accumulateur.

### event

onClick
onChange
onSubmit
onBlur: quand l’élément perd le focus

### if

```jsx
// CLASSIQUE
if (isOk=true) {
  value="Top"
} else {
  value="Oh no"
}

// TERNAIRE
isOk ? value="Top" : value="Oh no"

// PAS DE ELSE
isOk && value="Top"
```

## Librairies React utiles

- react-router-dom
- react-hook-form

Exemple: Ouverture / Fermeture d’un panier

```jsx
import { useState } from "react";
import "../styles/Cart.css";

function Cart() {
	const monsteraPrice = 8;
	const [cart, updateCart] = useState(0);
	const [isOpen, setIsOpen] = useState(true);

	return isOpen ? (
		<div className="lmj-cart">
			<button
				className="lmj-cart-toggle-button"
				onClick={() => setIsOpen(false)}
			>
				Fermer
			</button>
			<h2>Panier</h2>
			<div>Monstera : {monsteraPrice}€</div>
			<button onClick={() => updateCart(cart + 1)}>Ajouter</button>
			<h3>Total : {monsteraPrice * cart}€</h3>
			<button onClick={() => updateCart(0)}>Vider le panier</button>
		</div>
	) : (
		<div className="lmj-cart-closed">
			<button
				className="lmj-cart-toggle-button"
				onClick={() => setIsOpen(true)}
			>
				Ouvrir le Panier
			</button>
		</div>
	);
}
```
