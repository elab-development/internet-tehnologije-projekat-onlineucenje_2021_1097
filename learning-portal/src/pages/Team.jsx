import React from 'react';

import '../components/Team/team.css';
import '../components/About/about.css';
import Back from '../components/Back';
import TeamCard from '../components/Team/TeamCard';
import Awrapper from '../components/About/AWrapper';

const Team = () => {
  return (
    <>
      <Back title='Team' />
      <section className='team padding'>
        <div className='container grid'>
          <TeamCard />
        </div>
      </section>
      <Awrapper />
    </>
  );
};

export default Team;
