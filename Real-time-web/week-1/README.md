
#Real-Time Web - Exercises Week 1
##Exercise 3
Find a data resource and describe its limitations.

###The **FatSecret Platform API**
"The FatSecret Platform API is the number 1 food and nutrition database in the world, utilized by more than 10.000 developers, in more than 50 countries contributing in excess of 500 million API calls every month."

The API has a lot of data about food and its corresponding nutritional values. It also has food diaries and weight tracking for diet programs.

[The FatSecret Platform API](https://platform.fatsecret.com/api/)

####Limitations
#####Up to 5000 API calls a day
The basic API has a limited amount of API calls that can be done on a single day: 5000. Even though the amount calls has been limited, 5000 is still a big number of calls for one day.

#####It's a big API
The API is very big and has a lot of options, which might make it complex to use.

####Possibilities
#####Returns JSON format
The API returns the data in JSON format, which is a familiar data type.

#####A lot of data
The API has a lot of data about a lot of food. Allowing it to be used for exercising benefits.

#####Reliability
The API is utilized by more than 10.000 developers, with over 500 million API calls every month. This speaks for the API's quality. Also, the API has a great website and documentation, which add to the API's reliability.

##Exercise 4
Describe what your application should do and which aspects will be reactive.

###Create fitness recipes
The application will allow users to create recipes for fitness purposes. When creating a recipe, it will be important to specify the diet type it is meant for. The three options will be: bulking, cutting and maintaining. When recipes have been created they are added to the homepage which contains a live feed of newly created recipes.

####Target Audience
FitnessByte's target audience will be people who exercise and have a certain nutrition and/or weight goal. For example, are the recipes meant for 'cutting' or 'bulking'. But of course, the application can also be useful to people who just need some inspiration for dinner.

####MVP
- A homepage which contains a feed of newly added recipes.
- The ability to create recipes.
- The possibility of creating a user account, so users are able to see who created a certain recipe.

####Wishlist
- Keeping track of your fitness goals.
- Creating a group recipe with friends/training partners. Perhaps you want to eat rice, but don't know what else you want to add to your recipe. Let your friends add ingredients for you.
- Add feedback when a certain nutritional value is excessively present in a recipe.
- Add a nutrition API to show an ingredient's corresponding nutritional values.

####Reactive components
- When a recipe has been created it will be added to the live feed on the homepage.
- When an ingredient has been added to a recipe, the nutritional value will immediately be updated.

###App Structure
```
FitnessByte
│
│
└───Client
│    ├───Views
│    │     Home
│    │     Recipe maker
│    │  
│    ├───Style  
│    │
│    ├───JS
│       
└───Server        
      accounts/database.js
```
