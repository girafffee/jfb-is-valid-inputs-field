# JetFormBuilder Is Valid Inputs field
An addition to JetFormBuilder that registers a new statement for the conditional block, as well as a new Field Value for the Hidden Field.

In the conditional block, you will be able to display the blocks if all the fields are filled in correctly. In this case, the value 1 will be in the hidden field.


## Conditional Block Usage
Add a conditional block with the following condition

![image](https://user-images.githubusercontent.com/46720998/220131348-25a22216-1b46-4aaf-9cb5-ec20bb48e65b.png)

And we will get the following result:

![image](https://user-images.githubusercontent.com/46720998/220132982-b238df81-6dd8-4556-8b61-e5b663e19aa9.png)

![image](https://user-images.githubusercontent.com/46720998/220133222-dccbe1ba-dcdc-40ed-a0a0-992d1cbb2fc5.png)

## Hidden Field Usage
Add a hidden field with this setting

![image](https://user-images.githubusercontent.com/46720998/220131659-eea26b9d-53a0-4fed-bf38-7ca6e356921f.png)

In your Calculated Field, you can write something like this formula
```text
%is_valid% ? %first_field% + %second_field% : 0
```

And we will get the following result:

![image](https://user-images.githubusercontent.com/46720998/220133679-9341eb6e-62f4-4ecf-9e36-70ecb386b8f5.png)

![image](https://user-images.githubusercontent.com/46720998/220133758-ab86a02c-805c-4585-96a2-fc7ff3908cc1.png)
