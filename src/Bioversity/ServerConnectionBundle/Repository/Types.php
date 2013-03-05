<?php

namespace Bioversity\ServerConnectionBundle\Repository;

class Types{
    const kTYPE_ANY= 		':ANY';
    const kTYPE_STRING=		':TEXT';
    const kTYPE_INT=		':INT';
    const kTYPE_FLOAT=		':FLOAT';
    const kTYPE_BOOLEAN=	':BOOLEAN';
    const kTYPE_BINARY_STRING=	':BINARY';
    const kTYPE_DATE_STRING=	':DATE';
    const kTYPE_TIME_STRING=	':TIME';
    const kTYPE_REGEX_STRING=	':REGEX';
    const kTYPE_INT32=		':INT32';
    const kTYPE_INT64=		':INT64';
    const kTYPE_META=		':META';
    const kTYPE_PHP=		':PHP';
    const kTYPE_JSON=		':JSON';
    const kTYPE_XML=		':XML';
    const kTYPE_SVG=		':SVG';
    const kTYPE_STRUCT=		':STRUCT';
    const kTYPE_LSTRING=	':LSTRING';
    const kTYPE_STAMP=		':STAMP';
    const kTYPE_ENUM=		':ENUM';
    const kTYPE_ENUM_SET=	':SET';
    const kTYPE_REQUIRED=	':REQUIRED';
    const kTYPE_RESTRICTED=	':RESTRICTED';
    const kTYPE_COMPUTED=	':COMPUTED';
    const kTYPE_LOCKED=		':LOCKED';
    const kTYPE_ARRAY=		':ARRAY';
    const kTYPE_RELATION_IN=	':RELATION-IN';
    const kTYPE_RELATION_OUT=	':RELATION-OUT';
    const kTYPE_RELATION_ALL=	':RELATION-ALL';
    const kTYPE_MongoId=	':MongoId';
    const kTYPE_MongoCode=	':MongoCode';
}