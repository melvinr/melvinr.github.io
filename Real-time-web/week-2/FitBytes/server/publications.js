Meteor.publish('recipes', function() {
  return Recipes.find({}, {
    sort: {createdAt: -1}
  });
});
