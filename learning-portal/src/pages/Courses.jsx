import React from 'react';

import Back from '../components/Back';
import CoursesCard from '../components/Courses/CoursesCard';
import OnlineCourses from '../components/Courses/OnlineCourses';

const CourseHome = () => {
  return (
    <>
      <Back title='Explore Courses' />
      <CoursesCard />
      <OnlineCourses />
    </>
  );
};

export default CourseHome;
