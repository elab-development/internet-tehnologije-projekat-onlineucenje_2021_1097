// react imports
import React from 'react';

// components
import CocktailList from '../components/CocktailList';
import SearchForm from '../components/SearchForm';

const Home = () => {
  return (
    <main>
      <SearchForm />
      <CocktailList />
    </main>
  );
};

export default Home;
