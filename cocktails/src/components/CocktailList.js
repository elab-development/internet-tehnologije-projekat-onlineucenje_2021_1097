// react imports
import React from 'react';

// components
import Cocktail from './Cocktail';
import Loading from './Loading';

// context
import { useGlobalContext } from '../context';

const CocktailList = () => {
  const { cocktails, loading } = useGlobalContext();

  if (loading) {
    return <Loading />;
  }

  if (cocktails.length < 1) {
    return <h2 className='section-title'>No cocktails matched your search</h2>;
  }

  return (
    <section className='section'>
      <h2 className='section-title'>cocktails</h2>
      <div className='cocktails-center'>
        {cocktails.map((cocktail) => {
          return <Cocktail key={cocktail.di} {...cocktail} />;
        })}
      </div>
    </section>
  );
};

export default CocktailList;
