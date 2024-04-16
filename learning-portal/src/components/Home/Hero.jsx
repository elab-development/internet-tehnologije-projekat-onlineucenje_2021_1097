import React, { useEffect, useState } from 'react';
import axios from 'axios';

import Heading from '../Heading/Heading';
import './Hero.css';

const Hero = () => {
  const [quote, setQuote] = useState(null);

  useEffect(() => {
    const getQuote = async () => {
      const options = {
        method: 'GET',
        url: 'https://quotes-inspirational-quotes-motivational-quotes.p.rapidapi.com/quote',
        params: {
          token: 'ipworld.info',
        },
        headers: {
          'X-RapidAPI-Key':
            '2afeb6c589msh460b60b9edce7b9p1b644ajsne6adcfd25731',
          'X-RapidAPI-Host':
            'quotes-inspirational-quotes-motivational-quotes.p.rapidapi.com',
        },
      };

      try {
        const response = await axios.request(options);
        setQuote(response.data);
      } catch (error) {
        console.error(error);
      }
    };

    getQuote();
  }, []);

  return (
    <>
      <section className='hero'>
        <div className='container'>
          <div className='row'>
            <Heading
              subtitle='WELCOME TO ACADEMIA'
              title='Best Online Education Expertise'
            />
            {quote && (
              <p>
                {quote.text + ' - '}{' '}
                <span style={{ fontStyle: 'italic' }}>{quote.author}</span>
              </p>
            )}
            <div className='button'>
              <button className='primary-btn'>
                GET STARTED NOW <i className='fa fa-long-arrow-alt-right'></i>
              </button>
              <button>
                VIEW COURSE <i className='fa fa-long-arrow-alt-right'></i>
              </button>
            </div>
          </div>
        </div>
      </section>
      <div className='margin'></div>
    </>
  );
};

export default Hero;
