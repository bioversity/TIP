<?php

/*=======================================================================================
 *	IDENTIFICATION ATTRIBUTES															*
 *======================================================================================*/

/**
 * _id.
 *
 * Native identifier.
 *
 * This attribute contains the native unique identifier of the object. This identifier is
 * used as the default unique key for all objects and can have any scalar data type.
 *
 * Version 1: (kOFFSET_NID)[_id]
 */
define( "kTAG_NID",								'_id' );

/**
 * LID.
 *
 * Local identifier.
 *
 * This attribute contains the local unique identifier. This value represents the value that
 * uniquely identifies an object within a specific domain or namespace. It is by definition
 * a string constituting the suffix of the global identifier, {@link kTAG_GID}.
 *
 * Version 1: (kTAG_LID)[1]
 */
define( "kTAG_LID",								'1' );

/**
 * GID.
 *
 * Global identifier.
 *
 * This attribute contains the global unique identifier. This value represents the value
 * that uniquely identifies the object across domains and namespaces. This value is by
 * definition a string and will generally constitute the object's primary key
 * ({@link kTAG_NID}) in full or hashed form.
 *
 * Version 1: (kTAG_GID)[2]
 */
define( "kTAG_GID",								'2' );

/**
 * UID.
 *
 * Unique identifier.
 *
 * This attribute contains the hashed unique identifier of an object in which its
 * {@link kTAG_NID} is not related to the {@link kTAG_GID}. This is generally used when
 * the {@link kTAG_NID} is a sequence number.
 *
 * Version 1: (kTAG_UID)[21]
 */
define( "kTAG_UID",								'3' );

/**
 * SYNONYMS.
 *
 * Synonyms.
 *
 * This attribute contains a list of strings that represent alternate identifiers for the
 * hosting object. Synonyms do not have any relation to the namespace.
 *
 * Version 1: (kTAG_SYNONYMS)[7]
 */
define( "kTAG_SYNONYMS",						'4' );

/*=======================================================================================
 *	CLASSIFICATION ATTRIBUTES															*
 *======================================================================================*/

/**
 * CATEGORY.
 *
 * Category.
 *
 * This attribute is an enumerated set that contains all the categories to which the hosting
 * object belongs to.
 *
 * Version 1: (kTAG_CATEGORY)[12]
 */
define( "kTAG_CATEGORY",						'5' );

/**
 * KIND.
 *
 * Kind.
 *
 * This attribute is an enumerated set that defines the kind of the hosting object.
 *
 * Version 1: (kTAG_KIND)[13]
 */
define( "kTAG_KIND",							'6' );

/**
 * TYPE.
 *
 * Type.
 *
 * This attribute is an enumerated set that contains a combination of data type and
 * cardinality indicators which, combined, represet the data type of the hosting object.
 *
 * Version 1: (kTAG_TYPE)[14]
 */
define( "kTAG_TYPE",							'7' );

/**
 * CLASS.
 *
 * Class.
 *
 * This attribute is a string that represets the referenced object's class. This attribute
 * is used to instantiate the correct class once an object has been retrieved from its
 * container.
 *
 * Version 1: (kTAG_CLASS)[4]
 */
define( "kTAG_CLASS",							'8' );

/**
 * NAMESPACE.
 *
 * Namespace.
 *
 * This attribute is a reference to a term which represents the namespace of the current
 * object. The object local identifiers must be unique within the scope of the namespace.
 *
 * Version 1: (kTAG_NAMESPACE)[3]
 */
define( "kTAG_NAMESPACE",						'9' );

/*=======================================================================================
 *	DESCRIPTION ATTRIBUTES																*
 *======================================================================================*/

/**
 * LABEL.
 *
 * Label.
 *
 * This attribute represents the label, name or short description of the referenced object.
 * It is a {@link kTYPE_LSTRING} structure in which the label can be expressed in several
 * languages.
 *
 * Version 1: (kTAG_LABEL)[5]
 */
define( "kTAG_LABEL",							'10' );

/**
 * DEFINITION.
 *
 * Definition.
 *
 * This attribute represents the definition of the referenced object. It is an
 * {@link kTYPE_LSTRING} structure in which the definition can be expressed in several
 + languages. A definition is independent of the context.
 *
 * Version 1: (kTAG_DEFINITION)[??]
 */
define( "kTAG_DEFINITION",						'11' );

/**
 * DESCRIPTION.
 *
 * Description.
 *
 * This attribute represents the description of the referenced object. It is an
 * {@link kTYPE_LSTRING} structure in which the description can be expressed in several
 * languages. A description depends on the context.
 *
 * Version 1: (kTAG_DESCRIPTION)[6]
 */
define( "kTAG_DESCRIPTION",						'12' );

/**
 * NOTES.
 *
 * Notes.
 *
 * This attribute represents the notes or comments of the referenced object.
 * It is a {@link kTYPE_LSTRING} structure in which the description can be expressed in
 * several languages.
 *
 * Version 1: (kTAG_NOTES)[25]
 */
define( "kTAG_NOTES",							'13' );

/**
 * EXAMPLES.
 *
 * Examples.
 *
 * This attribute represents the examples or templates of the referenced object.
 * It is a list of strings where each string represents an example or template.
 *
 * Version 1: (kTAG_EXAMPLES)[28]
 */
define( "kTAG_EXAMPLES",						'14' );

/*=======================================================================================
 *	AUTHORSHIP ATTRIBUTES																*
 *======================================================================================*/

/**
 * AUTHORS.
 *
 * Authors.
 *
 * This attribute represents a list of authors, it is an array of author names.
 *
 * Version 1: (kTAG_AUTHORS)[24]
 */
define( "kTAG_AUTHORS",							'15' );

/**
 * ACKNOWLEDGMENTS.
 *
 * Acknowledgments.
 *
 * This attribute represents a list of generic acknowledgments, it is an array of strings.
 *
 * Version 1: (kTAG_ACKNOWLEDGMENTS)[26]
 */
define( "kTAG_ACKNOWLEDGMENTS",					'16' );

/**
 * BIBLIOGRAPHY.
 *
 * Bibliography.
 *
 * This attribute represents a list of bibliographic references, it is an array of strings.
 *
 * Version 1: (kTAG_BIBLIOGRAPHY)[27]
 */
define( "kTAG_BIBLIOGRAPHY",					'17' );

/*=======================================================================================
 *	REFERENCE ATTRIBUTES																*
 *======================================================================================*/

/**
 * TERM.
 *
 * Term.
 *
 * This attribute contains a reference to an object that represents the term of the
 * attribute host.
 *
 * Version 1: (kTAG_TERM)[8]
 */
define( "kTAG_TERM",							'18' );

/**
 * NODE.
 *
 * Node.
 *
 * This attribute contains a reference to an object that represents the master node of the
 * attribute host.
 *
 * Version 1: (kTAG_NODE)[??]
 */
define( "kTAG_NODE",							'19' );

/**
 * SUBJECT.
 *
 * Subject.
 *
 * This attribute contains a reference to an object that represents the start, origin or
 * subject vertex of a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 *
 * Version 1: (kTAG_VERTEX_SUBJECT)[18]
 */
define( "kTAG_SUBJECT",							'20' );

/**
 * kTAG_OBJECT.
 *
 * Object.
 *
 * This attribute contains a reference to an object that represents the end, destination or
 * object vertex of a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 *
 * Version 1: (kTAG_VERTEX_OBJECT)[20]
 */
define( "kTAG_OBJECT",							'21' );

/**
 * PREDICATE.
 *
 * Predicate.
 *
 * This attribute contains a reference to an object that represents the predicate term of a
 * <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 *
 * Version 1: (kTAG_PREDICATE)[19]
 */
define( "kTAG_PREDICATE",						'22' );

/**
 * PATH.
 *
 * Path.
 *
 * This attribute represents a sequence of <tt>vertex</tt>, <tt>predicate</tt>,
 * <tt>vertex</tt> elements whose concatenation represents a path between an origin vertex
 * and a destination vertex.
 *
 * Version 1: (kTAG_TAG_PATH)[22]
 */
define( "kTAG_PATH",							'23' );

/*=======================================================================================
 *	REFERENCE COLLECTIONS																*
 *======================================================================================*/

/**
 * NAMESPACE-REFS.
 *
 * Namespace references count.
 *
 * This integer attribute counts how many times external objects have referenced the current
 * one as a namespace.
 *
 * Version 1: (kTAG_REFS_NAMESPACE)[9]
 */
define( "kTAG_NAMESPACE_REFS",					'24' );

/**
 * NODES.
 *
 * Nodes.
 *
 * This attribute is a collection of node references, it is an array of node object native
 * identifiers who reference the current object.
 *
 * Version 1: (kTAG_REFS_NODE)[10]
 */
define( "kTAG_NODES",							'25' );

/**
 * EDGES.
 *
 * Edges.
 *
 * This attribute is a collection of edge references, it is an array of edge object native
 * identifiers who reference the current object.
 *
 * Version 1: (kTAG_REFS_EDGE)[17]
 */
define( "kTAG_EDGES",							'26' );

/**
 * FEATURES.
 *
 * Features.
 *
 * This attribute is a collection of feature references, it is an array of object native
 * identifiers that reference the current object as a feature or trait.
 *
 * Version 1: (kTAG_REFS_TAG_FEATURE)[15]
 */
define( "kTAG_FEATURES",						'27' );

/**
 * METHODS.
 *
 * Methods.
 *
 * This attribute is a collection of method references, it is an array of object native
 * identifiers that reference the current object as a method or modifier.
 *
 * Version 1: (kTAG_REFS_TAG_METHOD)[??]
 */
define( "kTAG_METHODS",							'28' );

/**
 * SCALES.
 *
 * Scales.
 *
 * This attribute is a collection of scale references, it is an array of object native
 * identifiers that reference the current object as a scale or unit.
 *
 * Version 1: (kTAG_REFS_TAG_SCALE)[16]
 */
define( "kTAG_SCALES",							'29' );

/*=======================================================================================
 *	USER OBJECT																			*
 *======================================================================================*/

/**
 * USER-NAME.
 *
 * User name.
 *
 * The full user name.
 *
 * Version 1: (kTAG_USER_NAME)[30]
 */
define( "kTAG_USER_NAME",						'30' );

/**
 * USER-CODE.
 *
 * User code.
 *
 * The code with which the user is known to the system.
 *
 * Version 1: (kTAG_USER_CODE)[31]
 */
define( "kTAG_USER_CODE",						'31' );

/**
 * USER-PASS.
 *
 * User password.
 *
 * The password with which the user is known to the system.
 *
 * Version 1: (kTAG_USER_PASS)[32]
 */
define( "kTAG_USER_PASS",						'32' );

/**
 * USER-MAIL.
 *
 * User e-mail.
 *
 * The e-mail address of the user.
 *
 * Version 1: (kTAG_USER_MAIL)[33]
 */
define( "kTAG_USER_MAIL",						'33' );

/**
 * USER-ROLE.
 *
 * User roles.
 *
 * The roles assigned to the user.
 *
 * Version 1: (kTAG_USER_ROLE)[34]
 */
define( "kTAG_USER_ROLE",						'34' );

/**
 * USER-PROFILE.
 *
 * User profile.
 *
 * The profile role name assigned to the user.
 *
 * Version 1: (kTAG_USER_PROFILE)[35]
 */
define( "kTAG_USER_PROFILE",					        '35' );

/**
 * USER-MANAGER.
 *
 * User manager.
 *
 * Reference to the user that manages the current user.
 *
 * Version 1: (kTAG_USER_MANAGER)[36]
 */
define( "kTAG_USER_MANAGER",					        '36' );