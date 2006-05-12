 <com:TCssDropDownMenuNode 
     ID="ViewUsers" 
     LinkUrl="?page=ViewUsersPage" 
     Text="View Users" 
     Roles="root,admin" 
     BorderColor="green" 
     BorderStyle="solid" 
     BorderWidth="1" 
     BackColor="white"/>



<com:TCssDropDownMenuNode 
     ID="ViewUsers" 
     LinkUrl="?page=ViewUsersPage" 
     Text="View Users" 
     Roles="root,admin" 
     BorderColor="green" 
     BorderStyle="solid" 
     BorderWidth="1" 
     BackColor="white"/>


<com:TCssDropDownMenu Horizontal="false" />


<com:TForm>
<com:TCssDropDownMenu ID="MainMenu" CssDirectory="js/cssdropdownmenu/css" CssHorizontalFile="cssdropdownmenu-horizontal_class.css" Horizontal="true" CssClass="nav" TopParentNodeCssClass="" ParentNodeCssClass="parent" NodeCssClass="node">
      <com:TCssDropDownMenuNode ID="Percoidei" Text="Percoidei">
         <com:TCssDropDownMenuNode ID="Remoras" Text="Remoras">
            <com:TCssDropDownMenuNode ID="Echeneis"  Text="Echeneis">
               <com:TCssDropDownMenuNode ID="Sharksucker" Text="Sharksucker" />
               <com:TContentPlaceHolder ID="WhitefinSharksucker" Text="Whitefin Sharksucker" />
            </com:TCssDropDownMenuNode>
          </com:TCssDropDownMenuNode>
      </com:TCssDropDownMenuNode>
      <com:TContentPlaceHolder ID="DynMenu" Text="Dynamic Menu" />
</com:TCssDropDownMenu>
</com:TForm>



<com:PNavMenuPanel>  

       <com:PNavMenuLinkContainer>

              <com:PNavMenuLink Page="Page1" />

       </com:PNavMenuLinkContainer>

       <com:PNavMenuLinkContainer>

              <com:PNavMenuLink Page="Page2" />

              <com:PNavMenuLinkContainer>

                     <com:PNavMenuLink Page="Page2_1" />

                     <com:PNavMenuLink Page="Page2_2" />

                     <com:PNavMenuLinkContainer>

                           <com:PNavMenuLink Page="Page2_2_1" />

                           <com:PNavMenuLink Page="Page2_2_2" />

                     </com:PNavMenuLinkContainer>

                     <com:PNavMenuLink Page="Page2_3" />

              </com:PNavMenuLinkContainer>

       </com:PNavMenuLinkContainer>

       <com:PNavMenuLinkContainer>

              <com:PNavMenuLink Page="Page3" />

              <com:PNavMenuLinkContainer>

                     <com:PNavMenuLink Page="Page3_1" />

              </com:PNavMenuLinkContainer>

       </com:PNavMenuLinkContainer>

</com:PNavMenuPanel>

